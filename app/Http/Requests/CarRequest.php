<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
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
            'dealer'=>['required'],
            'title'=>['required','string'],
            'slug'=>['required','unique:cars,slug'],
            'brand'=>['required'],
            'country'=>['required'],
            'city'=>['required'],
            'rent_period'=>['required'],
            'regular_price'=>['required','numeric'],
            'offer_price'=>['numeric','nullable'],
            'fuel_type'=>['required'],
           'car_image.*' => ['required', 'mimes:png,jpg,webp,svg,jpeg', 'max:2048'],
            'mileage'=>['required'],
            'engine_size'=>['required'],
            'purpose'=>['required'],
            'description'=>['required'],
            'feature'=>['required'],
            'seller_type'=>['required'],
            'body_type'=>['required'],
            'drive'=>['required'],
            'car_model'=>['required'],
            'year'=>['required','numeric'],
        ];
    }
    public function messages():array{
        return[
            'dealer.required'=>'User name is required!',
            'title.required'=>'Car name is required!',
            'title.string'=>'Car name must be string',
            'slug.required'=>'Slug is required!',
            'slug.unique'=>'Slug already used!',
            'brand.required'=>'Brand name is required!',
            'country.required'=> 'Country name is required',
            'city.required'=> 'City name is required',
            'rent_period.required'=> 'Rend period is required',
            'regular_price.required'=> 'Price is required',
            'regular_price.numeric'=> 'Price must be numeric',
            'offer_price.numeric'=> 'Price must be numeric',
            'fuel_type.required'=> 'Fuel is required!',
            'car_image.required'=> 'Image is required!',
            'car_image.mines'=> 'Image must be used png,jpg,webp,svg,jpeg',
            'mileage.required'=> 'Mileage is required!',
            'engine_size.required'=> 'Engine size is required!',
            'purpose.required'=> 'Purpose is required!',
            'description.required'=> 'Description is required!',
            'feature.required'=> 'Feature is required!',
            'seller_type.required'=> 'Seller type is required!',
            'body_type.required'=> 'Body type is required!',
            'drive.required'=> 'Drive is required!',
            'car_model.required'=> 'Car model is required!',
            'year.required'=> 'Year is required!',
            'year.numeric'=> 'Year is numeric!',
        ];
    }
}
