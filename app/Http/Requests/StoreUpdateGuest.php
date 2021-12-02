<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateGuest extends FormRequest
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
        // $id = $this->segment(3);

        $rules = [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'document' => ['required', 'string', 'min:3', 'max:255'],
            'photo' => ['nullable', 'image'],
            'destiny' => ['required', 'string', 'min:3', 'max:255'],
            'person' => ['required', 'string', 'min:3', 'max:255'],
            'company' => ['nullable', 'string', 'min:3', 'max:255'],
            'obs' => ['nullable', 'string', 'min:3', 'max:255'],
            'start_at' => ['required', 'string', 'min:3', 'max:255'],
            'expires_at' => ['required', 'string', 'min:3', 'max:255'],
        ];

        // if ($this->method() == 'PUT') {
        //     $rules['password'] = ['nullable', 'string', 'min:6', 'max:16'];
        // }

        return $rules;
    }
}
