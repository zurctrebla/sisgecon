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
        $id = $this->segment(3);

        // return [
        //     'name' => "required|min:3|max:255|unique:roles,name,{$id},id",
        // ];

        $rules = [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'document1' => ['required', 'string', 'min:3', 'max:255', "unique:guests,document1,{$id},id"],
            'document2' => ['nullable', 'string', 'min:3', 'max:255'],
            'authorization' => ['unique', 'string', 'min:3', 'max:255'],
            'photo' => ['nullable', 'image'],
            'destiny' => ['required', 'string', 'min:3', 'max:255'],
            'status' => ['nullable', 'string', 'min:3', 'max:255'],
            'authorized_At' => ['nullable', 'string', 'min:3', 'max:255'],
            'person' => ['required', 'string', 'min:3', 'max:255'],
            'company' => ['nullable', 'string', 'min:3', 'max:255'],
            'obs' => ['nullable', 'string', 'min:3', 'max:255'],
            'start_at' => ['required', 'string', 'min:3', 'max:255'],
            'expires_at' => ['required', 'string', 'min:3', 'max:255'],
        ];

        if ($this->method() == 'PUT') {
            $rules['password'] = ['nullable', 'string', 'min:6', 'max:16'];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'min' => 'Campo deve ter no mínimo 3 caracteres',
            'max' => 'Campo deve ter no máximo 255 caracteres',
            'unique' => 'O número do documento já está cadastrado',
        ];
    }
}
