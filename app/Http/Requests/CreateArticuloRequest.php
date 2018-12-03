<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Articulo;

class CreateArticuloRequest extends FormRequest
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
            //
            'id_categoria' => 'required',
            'id_marca' => 'required',
            'barcode' => 'required|max:50',
            'descripcion' => 'required|max:100',
            'stock' => 'required|numeric',
            'precio_venta' => 'required'
        ];
    }
}
