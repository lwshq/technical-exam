<?php

namespace App\Http\Requests;

use App\Traits\ResponserTrait;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\CustomRequests;

class NoteStoreRequest extends CustomRequests
{
    use ResponserTrait;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'     => ['required','max:32'],
            'note'         => 'required|min:10'
        ];
    }

    public function response(array $errors)
    {
        return $this->errorResponse($errors, 'Form Validation Error', 400);
    }

}
