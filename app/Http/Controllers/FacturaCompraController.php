<?php

namespace App\Http\Controllers;


use App\Repositories\ProductoRepository;
use App\Repositories\UserRepository;
use App\Models\TipoPago;
use Illuminate\Http\Request,
    App\Repositories\ProveedorRepository,
    App\Repositories\FacturaCompraRepository,
    App\Http\Requests,
    PDF;
class FacturaCompraController extends Controller
{
    private $_proveedorRepo;
    private $_productoRepo;
    private $_facturacompraRepo;
    private $_userRepo;

    public function __CONSTRUCT(
        ProveedorRepository $proveedorRepo,
        ProductoRepository $productoRepo,
        UserRepository $userRepo,
        FacturaCompraRepository $facturacompraRepo
    )
    {
        $this->_proveedorRepo = $proveedorRepo;
        $this->_productoRepo = $productoRepo;
        $this->_facturacompraRepo = $facturacompraRepo;
        $this->_userRepo = $userRepo;
    }

    public function index()
    {
        return view(
            'factura_compra.index', [
                'model' => $this->_facturacompraRepo->getAll()
            ]
        );
    }

    public function detail($id)
    {
        return view('factura_compra.detail', [
            'model' => $this->_facturacompraRepo->get($id)
        ]);
    }

    public function pdf($id)
    {
        $model = $this->_facturacompraRepo->get($id);
        $facturacompra_name = sprintf('comprobante-%s.pdf', str_pad ($model->id, 7, '0', STR_PAD_LEFT));

        $pdf = PDF::loadView('factura_compra.pdf', [
            'model' => $model
        ]);

        return $pdf->download($facturacompra_name);
    }

    public function add()
    {
        return view('factura_compra.add');
    }

    public function save(Request $req)
    {
        $data = (object)[
            'iva' => $req->input('iva'),
            'subTotal' => $req->input('subTotal'),
            'total' => $req->input('total'),
            'proveedor_id' => $req->input('proveedor_id'),
            'user_id' => $req->input('user_id'),
            'tipopago_id' => $req->input('tipopago_id'),
            'detail' => []
        ];

        foreach($req->input('detail') as $d){
            $data->detail[] = (object)[
                'producto_id' => $d['id'],
                'cantidad'   => $d['cantidad'],
                'precio_compra'  => $d['precio_compra'],
                'total'      => $d['total']
            ];
        }

        return $this->_facturacompraRepo->save($data);
    }

    public function findProveedor(Request $req)
    {
        return $this->_proveedorRepo
                    ->findByRazonSocial($req->input('q'));
    }

    public function findProducto(Request $req)
    {
        return $this->_productoRepo
                    ->findByDescripcion($req->input('q'));
    } 
     
}
