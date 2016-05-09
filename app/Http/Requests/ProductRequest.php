<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProductRequest extends Request
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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:100',
            'description' => 'required|min:1|max:300',
            
            'skus.*.id' => 'required',
            'skus.*.stock' => 'required|min:1',
            'skus.*.before_price' => 'required|numeric',
            'skus.*.price' => 'required|numeric',
            'skus.*.variants.*.id' => 'required|exists:options,id',

            'variants.*.options.*.title' => 'required'
        ];
    }

    /**
     * Response by JSON.
     * 
     * @param array $errors
     * @return \Illuminate\Http\JsonResponse
     */
    public function response(array $errors) 
    {
        return response()->json($errors);
    }
}
