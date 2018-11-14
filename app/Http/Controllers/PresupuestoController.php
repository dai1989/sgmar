<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request,
 App\Http\Requests;
use App\Repositories\ProductoRepository;
use App\Repositories\PersonaRepository;
use App\Repositories\PresupuestoRepository;
use App\Repositories\UsersRepository;
use App\User;
use App\Models\Persona;
use App\Models\Producto;
use App\Models\Presupuesto;
use App\Models\PresupuestoDetalle;
use App\Models\Stock;
use Barryvdh\DomPDF\Facade as PDF;

class PresupuestoController extends Controller
{
    private $_personaRepo;
    private $_productoRepo;
    private $_usersRepo;
    private $_presupuestoRepo;

    public function __CONSTRUCT(
        PersonaRepository $personaRepo,
        ProductoRepository $productoRepo,
        UsersRepository $usersRepo,
        PresupuestoRepository $presupuestoRepo
    )
    {
        $this->_personaRepo = $personaRepo;
        $this->_productoRepo = $productoRepo;
        $this->_usersRepo = $usersRepo;
        $this->_presupuestoRepo = $presupuestoRepo;
    }

    public function index()
    {
        return view(
            'presupuesto.index', [
                'model' => $this->_presupuestoRepo->getAll()
            ]
        );
    }

    public function detail($id)
    {
        return view('presupuesto.detail', [
            'model' => $this->_presupuestoRepo->get($id)
        ]);
    }

    public function pdf($id)
    {
        $model = $this->_presupuestoRepo->get($id);
        $presupuesto_name = sprintf('comprobante-%s.pdf', str_pad ($model->id, 7, '0', STR_PAD_LEFT));

        $pdf = PDF::loadView('presupuesto.pdf', [
            'model' => $model
        ]);

        return $pdf->download($presupuesto_name);
    }
    

    public function add()
    {
        return view('presupuesto.add');
    }

    public function save(Request $req)
    {
        $data = (object)[
          
            'iva' => $req->input('iva'),
            'subTotal' => $req->input('subTotal'),
            'presupuesto_fecha' => $req->input('presupuesto_fecha'),
            'total' => $req->input('total'),
            'persona_id' => $req->input('persona_id'),
            'user_id' => $req->input('user_id'),
            'detail' => []
        ];

        foreach($req->input('detail') as $d){
            $data->detail[] = (object)[
                'producto_id' => $d['id'],
                'cantidad'   => $d['cantidad'],
                'precio_venta'  => $d['precio_venta'],
                'total'      => $d['total']
            ];
        }

        return $this->_presupuestoRepo->save($data); 
    }

    public function findPersona(Request $req)
    {
        return $this->_personaRepo
                    ->findByNombre($req->input('q'));
    }

    public function findProducto(Request $req)
    {
        return $this->_productoRepo
                    ->findByDescripcion($req->input('q'));
    }
     public function findUser(Request $req)
    {
        return $this->_usersRepo
                    ->findByName($req->input('q'));
    }
}
