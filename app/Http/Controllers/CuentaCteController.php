<?php

namespace App\Http\Controllers;
use App\Repositories\ProductoRepository;

use Illuminate\Http\Request,
    App\Repositories\PersonaRepository,
    App\Repositories\CuentaCteRepository,
    App\Http\Requests;

use App\Models\Persona;
use App\Models\CuentaCte; 
use App\Models\Producto;
use App\Models\CuentaCteDetalle; 
use Barryvdh\DomPDF\Facade as PDF;
use App\User; 
class CuentaCteController extends Controller
{
    private $_autorizacionctacteRepo;
    private $_productoRepo;
    private $_cuentacteRepo;
    private $_userRepo;

    public function __CONSTRUCT(
        AutorizacionCtaCteRepository $autorizacionctacteRepo,
        ProductoRepository $productoRepo,
        UserRepository $userRepo,
        CuentaCteRepository $cuentacteRepo
    )
    {
        $this->_autorizacionctacteRepo = $autorizacionctacteRepo;
        $this->_productoRepo = $productoRepo;
        $this->_cuentacteRepo = $cuentacteRepo;
        $this->_userRepo = $userRepo;
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
        return $this->_userRepo
                    ->findByName($req->input('q'));
    }
}
