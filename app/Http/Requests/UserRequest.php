<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:60',
            'email' => 'required|string|email|unique:users,email',
            'phone' => 'required|string|regex:/^[\+]{0,1}380([0-9]{9})$/|unique:users,phone',
            'photo' => 'required|file|mimes:jpg,jpeg|max:5120|dimensions:min_width=70,min_height=70',
            'position_id' => 'required|integer|exists:positions,id',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
//        if(
//            ($validator->errors()->has('email') &&
//            str_contains($validator->errors()->get('email')[0], 'already been taken')) ||
//            ($validator->errors()->has('phone')) ||
//            str_contains($validator->errors()->get('phone')[0], 'already been taken'))
//        {
//            throw new HttpResponseException(response()->json([
//                'success' => false,
//                'message' => 'User with this email or phone already exists',
//            ], 409));
//        }
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'fails' => $validator->errors()
            ], 422)
        );
    }

    public function messages(): array
    {
        return [
            'photo' => [
                'max' => 'The photo may not be greater than 5 Mbytes.',
                'dimensions' => 'Minimum size of photo 70x70px.',
                'exists:positions,id' => 'The position id must be an existing position.',
            ],
        ];
    }
}
