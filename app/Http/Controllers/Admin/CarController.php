<?php

namespace App\Http\Controllers\Admin;


use App\Models\Car;
use App\Traits\ResponseIn;
use Illuminate\Http\Request;
use App\Repositories\CarRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Car\StoreCarRequest;
use App\Http\Requests\Car\UpdateCarRequest;
use Cviebrock\EloquentSluggable\Services\SlugService;

class CarController extends Controller
{
    use ResponseIn;

    /**
     * For identity menu dashboard active
     *
     * @var [string]
     */
    protected $type_menu;

    private $carRepository;

    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
        $this->type_menu = 'cars';
        view()->share('type_menu', $this->type_menu);
    }

    /**
     * Display a listing of the resource.
     *
     * @return mixed|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $data = $this->carRepository->carData();
        return view('pages.admin.car.index', [
            'data' => $data,
            'tData' => $data->count(),
            'tTrash' => $this->carRepository->viewTrashed()->count()
        ]);
    }

    /**
     * Display a listing of the Trash resource.
     *
     * @return mixed|\Illuminate\Contracts\View\View
     */
    public function trashed()
    {
        $data = $this->carRepository->viewTrashed();
        return view('pages.admin.car.trash', [
            'data' => $this->carRepository->viewTrashed(),
            'tData' => $this->carRepository->carData()->count(),
            'tTrash' => $data->count()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return mixed
     */
    public function create()
    {
        return view('pages.admin.car.create', [
            'car' => new Car,
            'data' => $this->carRepository->carDataController()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Car\StoreCarRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function store(StoreCarRequest $request)
    {

        $this->carRepository->storeCar($request);
        return redirect('/admin/cars')
            ->with('success_message', 'Car was successfully added.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return mixed
     */
    public function edit($id)
    {
        return view('pages.admin.car.edit', [
            // 'car' => new CarResource($this->carRepository->findResource($id)),
            'car' => $this->carRepository->findOrFail($id),
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
        $this->carRepository->updateCar($request, $car->id);
        return redirect('/admin/cars')
            ->with('success_message', 'Car was successfully update.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->carRepository->deleteCar($id);
    }

    /**
     * Undocumented function
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function duplicate(Request $request)
    {
        return $this->carRepository->replicateCar($request->id);
    }

    /**
     * Restore Data for All Model
     *
     * @param Request $request
     * @param int $request['id']
     * @return array
     */
    public function restore(Request $request)
    {
        return $this->carRepository->restore($request);
    }

    public function force(Request $request)
    {
        return $this->carRepository->forceCar($request->id);
    }

    public function bulk(Request $request)
    {
        return $this->carRepository->bulk($request->all());
    }
}
