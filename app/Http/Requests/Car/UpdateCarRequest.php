<?php

namespace App\Http\Requests\Car;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'slug' => 'required',
            'capacity' => 'required',
            'year' => 'required',
            'price' => 'required',
            'brandId' => 'required',
            'image' => 'nullable|mimes:png,jpg,jpeg',
        ];
    }
}
