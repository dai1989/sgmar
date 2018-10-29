<?php

namespace App\Repositories;

use App\Models\FacturaCompra;
use App\Models\FacturaCompraDetalle;

use DB;

class FacturaCompraRepository {
    private $model;
    
    public function __construct(){
        $this->model = new FacturaCompra();
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
            $this->model->user_id = $data->user_id;
            $this->model->tipopago_id = $data->tipopago_id;

            $this->model->save();

            $detail = [];
            foreach($data->detail as $d) {
                $obj = new FacturaCompraDetalle;

                $obj->producto_id = $d->producto_id;
                $obj->cantidad = $d->cantidad;
                $obj->precio_compra = $d->precio_compra;
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
