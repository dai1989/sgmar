<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Producto;

class CreateProductoRequest extends FormRequest 
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
            'categoria_id' => 'required',
            'marca_id' => 'required',
            'barcode' => 'required|unique:productos|max:13|min:12',
            'descripcion' => 'required|max:100',
            'stock' => 'required|numeric',
            'precio_venta' => 'required'
        ];
    }
}
