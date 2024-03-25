<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;



class StoreleaveRequestRequest extends FormRequest
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
            'user_id' => 'required',
            'leave_type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required',
            'reason' => 'required',
        ];
    }

        /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation($validator)
    {
        Log::debug('failed validation');
        throw new ValidationException($validator, response()->json([
            'message' => 'The given data was invalid.',
            'errors' => $validator->errors(),
        ], 422));
    }
}

