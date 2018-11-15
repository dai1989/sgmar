<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request,
 App\Http\Requests;
use App\Repositories\ProductoRepository;
use App\Repositories\AutorizacionesRepository;
use App\Repositories\CreditoRepository;
use App\Repositories\UsersRepository;
use App\User;
use App\Models\Persona;
use App\Models\Autorizacion;
use App\Models\Producto;
use App\Models\Credito;
use App\Models\CreditoDetalle;
use App\Models\Stock;
use Barryvdh\DomPDF\Facade as PDF;

class CreditoController extends Controller
{
    private $_creditoRepo;
    private $_productoRepo;
    private $_usersRepo;
    private $_autorizacionesRepo;

    public function __CONSTRUCT(
        CreditoRepository $creditoRepo,
        ProductoRepository $productoRepo,
        UsersRepository $usersRepo,
        AutorizacionesRepository $autorizacionesRepo
    )
    {
        $this->_creditoRepo = $creditoRepo;
        $this->_productoRepo = $productoRepo;
        $this->_usersRepo = $usersRepo;
        $this->_autorizacionesRepo = $autorizacionesRepo;
    }

    public function index()
    {
        return view(
            'credito.index', [
                'model' => $this->_creditoRepo->getAll()
            ]
        );
    }

    public function detail($id)
    {
        return view('credito.detail', [
            'model' => $this->_creditoRepo->get($id)
        ]);
    }

    public function pdf($id)
    {
        $model = $this->_creditoRepo->get($id);
        $credito_name = sprintf('comprobante-%s.pdf', str_pad ($model->id, 7, '0', STR_PAD_LEFT));

        $pdf = PDF::loadView('credito.pdf', [
            'model' => $model
        ]);

        return $pdf->download($credito_name);
    }
    

    public function add()
    {
        return view('credito.add');
    }

    public function save(Request $req)
    {
        $data = (object)[
          
            'iva' => $req->input('iva'),
            'subTotal' => $req->input('subTotal'),
            'total' => $req->input('total'),
            'autorizacion_id' => $req->input('autorizacion_id'),
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

        return $this->_creditoRepo->save($data); 
    }

    public function findAutorizacion(Request $req)
    {
        return $this->_autorizacionesRepo
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
