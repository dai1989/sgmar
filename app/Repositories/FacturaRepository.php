<?php

namespace App\Repositories;

use App\Models\Factura;
use App\Models\FacturaDetalle;
use DB;

class FacturaRepository {
    private $model;
    
    public function __construct(){
        $this->model = new Factura();
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

          
            
            
            
            
            $this->model->entrega = $data->entrega;
            $this->model->iva = $data->iva;
            $this->model->subTotal = $data->subTotal;
            $this->model->total = $data->total;
            $this->model->persona_id = $data->persona_id;
            $this->model->tipopago_id = $data->tipopago_id;
            $this->model->tipofactura_id = $data->tipofactura_id;
            $this->model->user_id = $data->user_id;

            $this->model->save();

            $detail = [];
            foreach($data->detail as $d) {
                $obj = new FacturaDetalle;

                $obj->producto_id = $d->producto_id;
                $obj->cantidad = $d->cantidad;
                $obj->precio_venta = $d->precio_venta;
              
                
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
