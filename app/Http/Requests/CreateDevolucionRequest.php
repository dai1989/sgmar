<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Devolucion;

class CreateDevolucionRequest extends FormRequest
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

            //para la devolucion
            'id_detalleventas' => 'required',
            'persona_id' => 'required',
            'tipo_comprobante' => 'required|max:20',
            'serie_comprobante' => 'max:7',
            'num_comprobante' => 'required|max:10',
            

            //para el detalle de la devolucion
            'id_producto' => 'required',
            'cantidad' => 'required',
            'precio_venta' => 'required',
            
            'observacion' => 'required'

        ];
    }
}
