<?php

namespace App\Repositories;

use App\Models\NotaCredito;
use App\Models\NotaCreditoDetalle;
use DB;

class NotaCreditoRepository {
    private $model;
    
    public function __construct(){
        $this->model = new NotaCredito();
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
            $this->model->id_venta = $data->id_venta;
            $this->model->user_id = $data->user_id;

            $this->model->save();

            $detail = [];
            foreach($data->detail as $d) {
                $obj = new NotaCreditoDetalle;

                $obj->id_producto = $d->id_producto;
                $obj->cantidad = $d->cantidad;
                $obj->observacion = $d->observacion;
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
