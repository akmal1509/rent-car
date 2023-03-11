<?php

namespace App\Http\Controllers\Admin;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type_menu = 'dashboard';
        return view('admin.dashboard', compact('type_menu'));
    }

    public function createSlug(Request $request)
    {
        $slug = SlugService::createSlug(Car::class, 'slug', $request->title);
        $type = $request->type;
        if ($type == 'cars') {
            $checkSlug = Car::where('slug', $slug)->first();
        }
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
