<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request,
 App\Http\Requests;
use App\Repositories\ProductoRepository;
use App\Repositories\AutorizacionCtaCteRepository;
use App\Repositories\CuentaCteRepository;
use App\Repositories\UsersRepository;
use App\User;
use App\Models\Persona;
use App\Models\Producto;
use App\Models\CuentaCte;
use App\Models\CuentaCteDetalle;
use Barryvdh\DomPDF\Facade as PDF;

class CuentaCteController extends Controller
{
    private $_autorizacionctacteRepo;
    private $_productoRepo;
    private $_usersRepo;
    private $_cuentacteRepo;

    public function __CONSTRUCT(
        AutorizacionCtaCteRepository $autorizacionctacteRepo,
        ProductoRepository $productoRepo,
        UsersRepository $usersRepo,
        CuentaCteRepository $cuentacteRepo
    )
    {
        $this->_autorizacionctacteRepo = $autorizacionctacteRepo;
        $this->_productoRepo = $productoRepo;
        $this->_usersRepo = $usersRepo;
        $this->_cuentacteRepo = $cuentacteRepo;
    }

    public function index()
    {
        return view(
            'cuentacte.index', [
                'model' => $this->_cuentacteRepo->getAll()
            ]
        );
    }

    public function detail($id)
    {
        return view('cuentacte.detail', [
            'model' => $this->_cuentacteRepo->get($id)
        ]);
    }

    public function pdf($id)
    {
        $model = $this->_cuentacteRepo->get($id);
        $cuentacte_name = sprintf('comprobante-%s.pdf', str_pad ($model->id, 7, '0', STR_PAD_LEFT));

        $pdf = PDF::loadView('cuentacte.pdf', [
            'model' => $model
        ]);

        return $pdf->download($cuentacte_name);
    }
    

    public function add()
    {
        return view('cuentacte.add');
    }

    public function save(Request $req)
    {
        $data = (object)[
          
            'iva' => $req->input('iva'),
            'subTotal' => $req->input('subTotal'),
            'total' => $req->input('total'),
            'autorizacionctacte_id' => $req->input('autorizacionctacte_id'),
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

        return $this->_cuentacteRepo->save($data); 
    }

    public function findAutorizacionCtaCte(Request $req)
    {
        return $this->_autorizacionctacteRepo
                    ->findByCodigo($req->input('q'));
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
