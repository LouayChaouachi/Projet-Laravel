<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'slug' => ['required', 'string', 'max:255', 'unique:cars,slug'],
            'brand' => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'year' => ['required', 'integer', 'between:2012,2026'],
            'transmission' => ['required', 'string', 'max:50'],
            'fuel_type' => ['required', 'string', 'max:50'],
            'seats' => ['required', 'integer', 'min:2', 'max:9'],
            'price_per_day' => ['required', 'numeric', 'min:10'],
            'image_url' => ['required', 'url'],
            'location' => ['required', 'string', 'max:255'],
            'available' => ['boolean'],
            'featured' => ['boolean'],
            'description' => ['nullable', 'string'],
        ];
    }
}
