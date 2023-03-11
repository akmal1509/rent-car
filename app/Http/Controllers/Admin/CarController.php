<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Car;
use App\Models\Brand;
use App\Models\Setting;
use App\Traits\HasImage;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\Car\StoreCarRequest;
use App\Http\Requests\Car\UpdateCarRequest;
use App\Repositories\CarRepository;
use Cviebrock\EloquentSluggable\Services\SlugService;

class CarController extends Controller
{
    use HasImage;
    protected $type_menu;

    private $carRepository;
    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
        $this->type_menu = 'car';
        view()->share('type_menu', $this->type_menu);
    }

    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index()
    {
        return view('admin.car.index', [
            'data' => Car::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return mixed
     */
    public function create()
    {
        return view('admin.car.create', [
            'car' => new Car,
            'data' => $this->carRepository->carDataController()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Car\StoreCarRequest  $request
     * @return \Illuminate\Http\Response
     */

    public function store(StoreCarRequest $request)
    {
        $this->carRepository->storeCar($request);
        return redirect('/admin/cars')
            ->with('success_message', 'Car was successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return mixed
     */
    public function edit(Car $car)
    {

        return view('admin.car.edit', [
            'car' => $car,
            'data' => $this->carRepository->carDataController()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Car\UpdateCarRequest  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarRequest $request, Car $car)
    {
        $this->carRepository->updateCar($request, $car);
        return redirect('/admin/cars')
            ->with('success_message', 'Car was successfully update.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        //
    }
}
