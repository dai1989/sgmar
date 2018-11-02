<?php

namespace App\Repositories;

use App\Models\Presupuesto;
use App\Models\PresupuestoDetalle;
use DB;

class PresupuestoRepository {
    private $model;
    
    public function __construct(){
        $this->model = new Presupuesto();
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

            $this->model->presupuesto_no = $data->presupuesto_no;
            $this->model->presupuesto_fecha = $data->presupuesto_fecha;
            $this->model->iva = $data->iva;
            $this->model->subTotal = $data->subTotal;
            $this->model->total = $data->total;
            $this->model->persona_id = $data->persona_id;
            $this->model->user_id = $data->user_id;

            $this->model->save();

            $detail = [];
            foreach($data->detail as $d) {
                $obj = new PresupuestoDetalle;

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
