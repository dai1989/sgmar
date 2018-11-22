<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request, 
 App\Http\Requests;
use App\Repositories\ProductoRepository;
use App\Repositories\PersonaRepository;
use App\Repositories\FacturaRepository;
use App\Repositories\UsersRepository;
use App\Repositories\TipoPagoRepository;
use App\Repositories\TipoFacturaRepository;
use App\User;
use App\Models\Persona;
use App\Models\TipoPago;
use App\Models\TipoFactura;
use App\Models\Producto;
use App\Models\Factura;
use App\Models\FacturaDetalle;
use App\Models\Stock;
use Barryvdh\DomPDF\Facade as PDF;
class FacturaController extends Controller
{
    private $_facturaRepo;
    private $_productoRepo;
    private $_usersRepo;
    private $_personaRepo;
    private $_tipopagoRepo;
    private $_tipofacturaRepo;

    public function __CONSTRUCT(
        FacturaRepository $facturaRepo,
        ProductoRepository $productoRepo,
        UsersRepository $usersRepo,
        PersonaRepository $personaRepo,
        TipoPagoRepository $tipopagoRepo,
        TipoFacturaRepository $tipofacturaRepo
    )
    {
        $this->_facturaRepo = $facturaRepo;
        $this->_productoRepo = $productoRepo;
        $this->_usersRepo = $usersRepo;
        $this->_personaRepo = $personaRepo;
        $this->_tipopagoRepo = $tipopagoRepo;
        $this->_tipofacturaRepo = $tipofacturaRepo;
    }

    public function index()
    {
        return view(
            'factura.index', [
                'model' => $this->_facturaRepo->getAll()
            ]
        );
    }

    public function detail($id)
    {
        return view('factura.detail', [
            'model' => $this->_facturaRepo->get($id)
        ]);
    }

    public function pdf($id)
    {
        $model = $this->_facturaRepo->get($id);
        $factura_name = sprintf('comprobante-%s.pdf', str_pad ($model->id, 7, '0', STR_PAD_LEFT));

        $pdf = PDF::loadView('factura.pdf', [
            'model' => $model
        ]);

        return $pdf->download($factura_name);
    }
    

    public function add()
    {
        return view('factura.add');
    }

    public function save(Request $req)
    {
        $data = (object)[
          
            
            
            'iva' => $req->input('iva'),
            'subTotal' => $req->input('subTotal'),
            'total' => $req->input('total'),
            'persona_id' => $req->input('persona_id'),
            'tipopago_id' => $req->input('tipopago_id'),
            'tipofactura_id' => $req->input('tipofactura_id'),
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

        return $this->_facturaRepo->save($data); 
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

     public function findTipoPago(Request $req)
    {
        return $this->_tipopagoRepo
                    ->findByDescripcionPago($req->input('q'));
    }

     public function findTipoFactura(Request $req)
    {
        return $this->_tipofacturaRepo
                    ->findByDescripcion($req->input('q'));
    }
}
