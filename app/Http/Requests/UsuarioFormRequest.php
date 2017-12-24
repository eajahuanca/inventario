<?php

namespace compusystem\Http\Requests;

use compusystem\Http\Requests\Request;

class UsuarioFormRequest extends Request
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
            'idtipo_usuario' => 'required',

            'name' => 'required|max:255',
            'ap_paterno' => 'required|max:255',
            'ci' => 'required|max:10',

            'fecha_nacimiento' => 'required',
            'genero' => 'required',

            'email' => 'required|email|max:255',
            'password' => 'required|min:6|confirmed',
        ];
    }
}
