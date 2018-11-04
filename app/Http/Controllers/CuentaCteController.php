<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request,
 App\Http\Requests;
use App\Repositories\ProductoRepository;
use App\Repositories\PersonaRepository;
use App\Repositories\CuentaCteRepository;
use App\Repositories\UserRepository;
use App\User;
use App\Models\Persona;
use App\Models\Producto;
use App\Models\CuentaCte;
use App\Models\CuentaCteDetalle;
use Barryvdh\DomPDF\Facade as PDF;

class CuentaCteController extends Controller
{
    private $_personaRepo;
    private $_productoRepo;
    private $_userRepo;
    private $_cuentacteRepo;

    public function __CONSTRUCT(
        PersonaRepository $personaRepo,
        ProductoRepository $productoRepo,
        UserRepository $userRepo,
        CuentaCteRepository $cuentacteRepo
    )
    {
        $this->_personaRepo = $personaRepo;
        $this->_productoRepo = $productoRepo;
        $this->_userRepo = $userRepo;
        $this->_cuentacteRepo = $cuentacteRepo;
    }

    public function index()
    {
        return view(
            'cuenta_cte.index', [
                'model' => $this->_cuentacteRepo->getAll()
            ]
        );
    }

    public function detail($id)
    {
        return view('cuenta_cte.detail', [
            'model' => $this->_cuentacteRepo->get($id)
        ]);
    }

    public function pdf($id)
    {
        $model = $this->_cuentacteRepo->get($id);
        $cuentacte_name = sprintf('comprobante-%s.pdf', str_pad ($model->id, 7, '0', STR_PAD_LEFT));

        $pdf = PDF::loadView('cuenta_cte.pdf', [
            'model' => $model
        ]);

        return $pdf->download($cuentacte_name);
    }
    

    public function add()
    {
        return view('cuenta_cte.add');
    }

    public function save(Request $req)
    {
        $data = (object)[
          
            'iva' => $req->input('iva'),
            'subTotal' => $req->input('subTotal'),
            'total' => $req->input('total'),
            'persona_id' => $req->input('persona_id'),
            'user_id' => $req->input('user_id'),
            'detail' => []
        ];

        foreach($req->input('detail') as $d){
            $data->detail[] = (object)[
                'producto_id' => $d['id'],
                'cantidad'   => $d['cantidad'],
                'entrega'   => $d['entrega'],
                'precio_venta'  => $d['precio_venta'],
                'total'      => $d['total']
            ];
        }

        return $this->_cuentacteRepo->save($data); 
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
    
}

