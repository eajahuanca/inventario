<?php

namespace compusystem\Http\Requests;

use compusystem\Http\Requests\Request;

class SucursalFormRequest extends Request
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
            'idempresa'=>'required',
            'sucursal'=>'required',
            'direccion'=>'required',
            'departamento'=>'required',
            'telefono'=>'required|numeric',
            'celular'=>'required|numeric',
        ];
    }
}
