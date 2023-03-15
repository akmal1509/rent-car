<?php

namespace App\Http\Controllers\Admin;

use App\Models\Car;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Repositories\CarRepository;

class GeneralController extends Controller
{

    private $type;
    protected $model;
    // private $modelName;
    private $repository;

    private $baseRepository;

    public function __construct(Request $request, BaseRepository $baseRepository)
    {
        $this->type = $request->type;
        // $this->carRepository = $carRepository;
        $this->baseRepository = $baseRepository;
        $this->repository =  '\App\Repositories' . '\\' .  $this->type . 'Repository';
        $this->model = '\App\Models' . '\\' . $this->type;
    }

    /**
     * Check Duplicate Slug
     * This action response for change field slug when 'name' or 'title' of data has change
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createSlug(Request $request)
    {
        $slug = $request->title;
        $checkSlug = $this->model::where('slug', $slug)->first();

        if ($checkSlug) {
            $status = 'Slug is Already';
        } else {
            $status = '';
        }
        return response()->json([
            'slug' => $slug,
            'status' => $status
        ]);
    }

    /**
     * Check Duplicate Slug
     * This action for feedback when slug has change
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkSlug(Request $request)
    {
        $slug = $request->title;
        $checkSlug = $this->model::where('slug', $slug)->first();

        if ($checkSlug) {
            $status = 'Slug is Already';
        } else {
            $status = '';
        }
        return response()->json([
            'slug' => $slug,
            'status' => $status
        ]);
    }
}
