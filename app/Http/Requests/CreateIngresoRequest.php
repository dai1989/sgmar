<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Ingreso;

class CreateIngresoRequest extends FormRequest
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

            //para el ingreso
            'id_proveedor' => 'required',
            'tipo_comprobante' => 'required|max:20',
            'serie_comprobante' => 'required',
            'num_comprobante' => 'required',

            //para el detalle de ingreso
            'id_producto' => 'required',
            'cantidad' => 'required',
            'precio_compra' => 'required'            
            
        ];
    }
}
