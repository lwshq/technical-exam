<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

abstract class CustomRequests extends FormRequest
{
    /**
     * Determine if user authorized to make this request
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    
    /**
     * If validator fails return the exception in json form
     * @param Validator $validator
     * @return array
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            $this->response( $this->formatErrors($validator) )
        );
    }

    protected function formatErrors(Validator $validator)
    {
        return $validator->getMessageBag()->toArray();
    }

    public function response(array $errors)
    {
        return $errors;
        if( $this->exepectsJson() ){
            return new JsonResponse($errors, 422);
        }

        return $this->redirector
            ->to($this->getRedirectUrl())
            ->withInput($this->except($this->dontFlash))
            ->withErrors($errors, $this->errorBag);
    }

    abstract public function rules();
}

