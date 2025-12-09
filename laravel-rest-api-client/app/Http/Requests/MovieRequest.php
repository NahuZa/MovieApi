<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
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

        if($this->method() == 'PATCH' || $this->method() == 'POST')
        {
            return [
                'name' => 'required|string|min:3',
        'categories_id' => 'required|integer',
        'description' => 'required|string|min:3',
        'pic_path' => 'required|string',
        'length' => 'required|string',
        'release_date' => 'required|string',
            ];
        }
        return [

        'name' => 'required|string|min:3',
        'categories_id' => 'required|integer',
        'description' => 'required|string|min:3',
        'pic_path' => 'required|string',
        'length' => 'required|string',
        'release_date' => 'required|string',

        ];
    }
}
