<?php

namespace App\Http\Controllers\Api;

use App\Models\Car;
use App\Traits\HasImage;
use Illuminate\Http\Request;
use App\Repositories\CarRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Car\UpdateCarRequest;
use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\Car\StoreCarRequest;
use Cviebrock\EloquentSluggable\Services\SlugService;

class CarController extends Controller
{
    use HasImage;

    private $carRepository;

    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json([
            "data" =>  $this->carRepository->carData()
        ],);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function store(StoreCarRequest $request)
    {
        $result = $this->carRepository->storeCar($request);

        return response()->json([
            "data" =>  $result
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCarRequest $request, $id)
    {
        $result = $this->carRepository->updateCar($request, $id);

        return response()->json([
            "data" =>  $result
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $result = $this->carRepository->deleteCar($id);
        return response()->json([
            "data" =>  $result
        ]);
    }
}
