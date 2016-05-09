<?php

namespace App\Http\Requests;

use Auth;
use App\Http\Requests\Request;

class OrderRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->customer;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'card_name' => 'required',
            'card_number' => 'required',
            'card_expiration_date' => 'required',
            'card_cv_code' => 'required|min:3|max:3'
        ];
    }
}
