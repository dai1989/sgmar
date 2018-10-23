<?php

namespace App\Repositories;

use App\Models\FacturaCompra;
use App\Models\DetalleFacturaCompra;
use App\InvoiceItem;
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

            $this->model->fac_numero = $data->fac_numero; 
            $this->model->fac_tipo = $data->fac_tipo;
            $this->model->fac_fecha = $data->fac_fecha;
            $this->model->proveedor_id = $data->proveedor_id;
            $this->model->user_id = $data->user_id;
            $this->model->tipopago_id = $data->tipopago_id;

            $this->model->save();

            $detail = [];
            foreach($data->detail as $d) {
                $obj = new DetalleFacturaCompra;

                $obj->producto_id = $d->producto_id;
                $obj->cantidad = $d->cantidad;
                $obj->precio_compra = $d->precio_compra;
                

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
