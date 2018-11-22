<?php

namespace App\Repositories;

use App\Models\Compra;
use App\Models\CompraDetalle;
use DB;

class CompraRepository {
    private $model;
    
    public function __construct(){
        $this->model = new Compra();
    }

    public function get($id) {
        return $this->model->find($id);
    }

    public function getAll() {
        return $this->model->orderBy('id', 'desc')->get();
    }

    public function save($data) {
        $return = (object)[
            'response' => false
        ];

        try {
            DB::beginTransaction();

          
            
            
            $this->model->iva = $data->iva;
            $this->model->subTotal = $data->subTotal;
            $this->model->total = $data->total;
            $this->model->proveedor_id = $data->proveedor_id;
            $this->model->tipopago_id = $data->tipopago_id;
            $this->model->tipofactura_id = $data->tipofactura_id;
            $this->model->user_id = $data->user_id;

            $this->model->save();

            $detail = [];
            foreach($data->detail as $d) {
                $obj = new FacturaDetalle;

                $obj->producto_id = $d->producto_id;
                $obj->cantidad = $d->cantidad;
                $obj->precio = $d->precio;
                $obj->total = $d->total;

                $detail[] = $obj;
            }

            $this->model->detail()->saveMany($detail);
            $return->response = true;

            DB::commit();
        } catch (\Exception $e){
            DB::rollBack();
        }

        return json_encode($return);
    }
}
