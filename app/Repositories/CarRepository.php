<?php

namespace App\Repositories;

use App\Models\Car;
use App\Models\Brand;
use App\Models\Setting;
use App\Traits\HasImage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

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
        $result = $data->all();
        $result['userId'] = Auth()->user()->id;
        $result['slug'] = SlugService::createSlug(Car::class, 'slug', $data->slug);
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
        $checkSlug = $this->model->where('slug', $data->slug)->first();
        if ($checkSlug) {
            $result['slug'] = Str::slug($data->slug);
        } else {
            $result['slug'] = SlugService::createSlug(Car::class, 'slug', $data->slug);
        }
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
        $result = [
            'years' => \Carbon::now()->year,
            'currency' => Setting::pluck('currency')->first(),
            'brand' => Brand::all()
        ];

        return $result;
    }

    /**
     * Delete Car Data
     *
     * @param int $id
     * @return mixed
     */
    public function deleteCar($id)
    {
        $result = $this->model->findOrFail($id);
        $this->deleteImage($result->image);
        $result->slug = SlugService::createSlug(Car::class, 'slug', Str::random(8));
        $result->save();
        return $result->delete();
    }

    /**
     * Replicate Car Data
     *
     * @param int $id
     * @return Model
     */
    public function replicateCar($id)
    {
        $data = $this->model->findOrFail($id);
        $result = $data->replicate();
        $result->slug = SlugService::createSlug(Car::class, 'slug', $data->slug);
        $result->created_at = \Carbon::now();
        $result->image =  $this->duplicateImage($data->image);
        $result->save();
        \Session::flash('success_message', 'Car was successfully duplicate.');

        return $result;
    }

    /**
     * Bulk Action Car Data
     *
     * @param array|mixed $request
     * @return void
     */
    public function bulk($request)
    {
        $action = $request->action;
        $data = $this->model->whereIn('id', $request->id)->$action();
        if ($action == 'forceDelete') {
            $action = 'delete permanent';
        }
        \Session::flash('success_message', 'Car was successfully' . $action);
        return;
    }

    /**
     * Restore Car data
     *
     * @param array|mixed $request
     * @return mixed
     */
    public function restore($request)
    {
        $data = $this->model->onlyTrashed()->where('id', $request->id)->first();
        $this->restoreImage($data->image);
        $result = $data->restore();

        \Session::flash('success_message', 'Car was successfully Restore.');
        return $result;
    }

    /**
     * Force Car Data
     *
     * @param int $id
     * @return mixed
     */
    public function forceCar($id)
    {
        $data = $this->model->onlyTrashed()->where('id', $id)->first();
        $result = $data->forceDelete();
        $this->forceImage($data->image);
        \Session::flash('success_message', 'Car was successfully Delete Permanent.');
        return;
    }
}
