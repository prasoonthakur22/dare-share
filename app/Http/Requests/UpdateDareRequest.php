<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDareRequest extends FormRequest
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
            'dare_title' => 'nullable|string|max:255',
            'dare_description' => 'nullable|string',
            'dare_image' => 'nullable|mimes:jpeg,jpg,png|max:1024000',
        ];
    }
}
