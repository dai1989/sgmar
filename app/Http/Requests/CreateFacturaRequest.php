<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Factura;

class CreateFacturaRequest extends FormRequest
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

            //para la venta
            'idcliente' => 'required',
            'tipo_comprobante' => 'required|max:20',
            'serie_comprobante' => 'max:7',
            'num_comprobante' => 'required|max:10',
            'total_venta' => 'required',

            //para el detalle de la venta
            'idproducto' => 'required',
            'cantidad' => 'required',
            'precio_venta' => 'required',
            'descuento' => 'required'

        ];
    }
}
