<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Car;
use App\Models\Brand;
use App\Models\Setting;
use App\Traits\HasImage;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;

class CarRepository extends BaseRepository
{
    use HasImage;
    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(Car $model)
    {
        $this->model = $model;
    }

    /**
     * Store Car Data
     *
     * @param array|mixed $data
     * @return Model|null
     */
    public function storeCar($data)
    {
        $detail = $this->model;

        $result = $data->all();
        $checkSlug = $detail->checkSlug($data->slug);
        if ($checkSlug) {
            $result['slug'] = SlugService::createSlug(Car::class, 'slug', $data->name);
        }

        $result['price'] = str_replace(',', '', $data->price);
        $result['image'] = $this->uploadImage($data);

        return $this->model->create($result);
    }

    /**
     * Update Car Data
     * @param int $id
     * @param array|mixed $data
     * @return bool|mixed
     */
    public function updateCar($data, $id)
    {
        $detail = $this->model->findOrFail($id);

        $result = $data->all();
        $result['slug'] = SlugService::createSlug(Car::class, 'slug', $data->name);
        $result['price'] = str_replace(',', '', $data->price);
        if ($data->file('image')) {
            Storage::delete('upload/images/' . $detail->image);
            $result['image'] = $this->uploadImage($data);
        }

        return $detail->update($result);
    }

    /**
     * Return All Data from last
     *
     * @return Collection|null
     */
    public function carData()
    {
        return $this->model->latest()->get();
    }

    /**
     * Car Data Form Controller Admin
     *
     * @return mixed
     */
    public function carDataController()
    {
        $data = [
            'years' => Carbon::now()->year,
            'currency' => Setting::pluck('currency')->first(),
            'brand' => Brand::all()
        ];

        return $data;
    }

    public function deleteCar($id)
    {
        $detail = $this->model->findOrFail($id);
        Storage::move('upload/images/' . $detail->image, 'tmp/' . $detail->image);
        // Storage::delete('upload/images/' . $detail->image);
        return $detail->delete();
    }
}
