<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request, 
 App\Http\Requests;
use App\Repositories\ProductoRepository;
use App\Repositories\PersonaRepository;
use App\Repositories\NotaCreditoRepository;
use App\Repositories\UsersRepository;
use App\Repositories\VentaRepository;
use App\Repositories\TipoPagoRepository;
use App\Repositories\TipoFacturaRepository;
use App\User;
use App\Models\Persona;
use App\Models\Venta;
use App\Models\TipoPago;
use App\Models\TipoFactura;
use App\Models\Producto;
use App\Models\NotaCredito;
use App\Models\NotaCreditoDetalle;

use Barryvdh\DomPDF\Facade as PDF;
class NotaCreditoController extends Controller
{
    private $_notacreditoRepo;
    private $_ventaRepo;
    private $_productoRepo;
    private $_usersRepo;
    
    private $_tipopagoRepo;
    private $_tipofacturaRepo;

    public function __CONSTRUCT(
        NotaCreditoRepository $notacreditoRepo,
        VentaRepository $ventaRepo,
        ProductoRepository $productoRepo,
        UsersRepository $usersRepo,
        
        TipoPagoRepository $tipopagoRepo,
        TipoFacturaRepository $tipofacturaRepo
    )
    {
        $this->_notacreditoRepo = $notacreditoRepo;
        $this->_ventaRepo = $ventaRepo;
        $this->_productoRepo = $productoRepo;
        $this->_usersRepo = $usersRepo;
        
        $this->_tipopagoRepo = $tipopagoRepo;
        $this->_tipofacturaRepo = $tipofacturaRepo;
    }

    public function index()
    {
        return view(
            'notacredito.index', [
                'model' => $this->_notacreditoRepo->getAll()
            ]
        );
    }

    public function detail($id)
    {
        return view('notacredito.detail', [
            'model' => $this->_notacreditoRepo->get($id)
        ]);
    }

    public function pdf($id)
    {
        $model = $this->_notacreditoRepo->get($id);
        $factura_name = sprintf('comprobante-%s.pdf', str_pad ($model->id, 7, '0', STR_PAD_LEFT));

        $pdf = PDF::loadView('notacredito.pdf', [
            'model' => $model
        ]);

        return $pdf->download($factura_name);
    }
    

    public function add()
    {
        return view('notacredito.add');
    }

    public function save(Request $req)
    {
        $data = (object)[
          
            
            
            
            
            'iva' => $req->input('iva'),
            'subTotal' => $req->input('subTotal'),
            'total' => $req->input('total'),
            
            'id_venta' => $req->input('id_venta'),
           
            'user_id' => $req->input('user_id'),
            'detail' => []
        ];

        foreach($req->input('detail') as $d){
            $data->detail[] = (object)[
                'id_producto' => $d['id_producto'],
                'cantidad'   => $d['cantidad'],
                'precio_venta'  => $d['precio_venta'],
                'observacion'  => $d['observacion'],
                
            
                'total'      => $d['total']
            ];
        }

        return $this->_notacreditoRepo->save($data); 
    }

    public function findPersona(Request $req)
    {
        return $this->_personaRepo
                    ->findByNombre($req->input('q'));
    }
     public function findVenta(Request $req)
    {
        return $this->_ventaRepo
                    ->findByNum_comprobante($req->input('q'));
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
