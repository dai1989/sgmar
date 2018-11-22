<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request, 
 App\Http\Requests;
use App\Repositories\ProductoRepository;
use App\Repositories\ProveedoresRepository;
use App\Repositories\CompraRepository;
use App\Repositories\UsersRepository;
use App\Repositories\TipoPagoRepository;
use App\Repositories\TipoFacturaRepository;
use App\User;
use App\Models\Proveedor;
use App\Models\TipoPago;
use App\Models\TipoFactura;
use App\Models\Producto;
use App\Models\Compra;
use App\Models\CompraDetalle;
use App\Models\Stock;
use Barryvdh\DomPDF\Facade as PDF;

class CompraController extends Controller
{
    private $_compraRepo;
    private $_productoRepo;
    private $_usersRepo;
    private $_proveedoresRepo;
    private $_tipopagoRepo;
    private $_tipofacturaRepo;

    public function __CONSTRUCT(
        CompraRepository $compraRepo,
        ProductoRepository $productoRepo,
        UsersRepository $usersRepo,
        ProveedoresRepository $proveedoresRepo,
        TipoPagoRepository $tipopagoRepo,
        TipoFacturaRepository $tipofacturaRepo
    )
    {
        $this->_compraRepo = $compraRepo;
        $this->_productoRepo = $productoRepo;
        $this->_usersRepo = $usersRepo;
        $this->_proveedoresRepo = $proveedoresRepo;
        $this->_tipopagoRepo = $tipopagoRepo;
        $this->_tipofacturaRepo = $tipofacturaRepo;
    }

    public function index()
    {
        return view(
            'compra.index', [
                'model' => $this->_compraRepo->getAll()
            ]
        );
    }

    public function detail($id)
    {
        return view('compra.detail', [
            'model' => $this->_compraRepo->get($id)
        ]);
    }

    public function pdf($id)
    {
        $model = $this->_compraRepo->get($id);
        $compra_name = sprintf('comprobante-%s.pdf', str_pad ($model->id, 7, '0', STR_PAD_LEFT));

        $pdf = PDF::loadView('compra.pdf', [
            'model' => $model
        ]);

        return $pdf->download($compra_name);
    }
    

    public function add()
    {
        return view('compra.add');
    }

    public function save(Request $req)
    {
        $data = (object)[
          
            
            
            'iva' => $req->input('iva'),
            'subTotal' => $req->input('subTotal'),
            'total' => $req->input('total'),
            'proveedor_id' => $req->input('proveedor_id'),
            'tipopago_id' => $req->input('tipopago_id'),
            'tipofactura_id' => $req->input('tipofactura_id'),
            'user_id' => $req->input('user_id'),
            'detail' => []
        ];

        foreach($req->input('detail') as $d){
            $data->detail[] = (object)[
                'producto_id' => $d['id'],
                'cantidad'   => $d['cantidad'],
                'precio'  => $d['precio'],
                'total'      => $d['total']
            ];
        }

        return $this->_compraRepo->save($data); 
    }

    public function findProveedor(Request $req)
    {
        return $this->_proveedoresRepo
                    ->findByRazonSocial($req->input('q'));
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
