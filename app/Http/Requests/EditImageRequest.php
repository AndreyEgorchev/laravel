<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditImageRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'image' => 'mimes:jpeg,jpg,bmp,png | max:1000',
            'mobile_image' => 'mimes:jpeg,jpg,bmp,png | max:1000'
        ];
    }
}
