<?php

namespace compusystem\Http\Requests;

use compusystem\Http\Requests\Request;

class EmpresaFormRequest extends Request
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
            'nombre'=>'required',
            'representante_legal'=>'required',
            'razon_social'=>'required',
            'actividad_economica'=>'required',
            'nit'=>'required|numeric',
            'imagen'=>'mimes:jpeg,bmp,png'
        ];
    }
}
