<?php

namespace App\Repositories;

use App\Models\CuentaCte;
use App\Models\CuentaCteDetalle;

use DB;

class CuentaCteRepository {
    private $model;
    
    public function __construct(){
        $this->model = new CuentaCte();
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
            
            
            $this->model->persona_id = $data->persona_id;
            

            $this->model->save();

            $detail = [];
            foreach($data->detail as $d) {
                $obj = new CuentaCteDetalle;

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
