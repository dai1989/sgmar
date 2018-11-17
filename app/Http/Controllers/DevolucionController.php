<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request,
 App\Http\Requests;
use App\Repositories\ProductoRepository;
use App\Repositories\InvoicesRepository;
use App\Repositories\DevolucionRepository;
use App\Repositories\UsersRepository;
use App\User;
use App\Models\Persona;
use App\Invoice;
use App\Models\Producto;
use App\Models\Devolucion;
use App\Models\DevolucionDetalle;
use App\Models\Stock;
use Barryvdh\DomPDF\Facade as PDF;

class DevolucionController extends Controller
{
    private $_devolucionRepo;
    private $_productoRepo;
    private $_usersRepo;
    private $_invoicesRepo;

    public function __CONSTRUCT(
        DevolucionRepository $devolucionRepo,
        ProductoRepository $productoRepo,
        UsersRepository $usersRepo,
        InvoicesRepository $invoicesRepo
    )
    {
        $this->_devolucionRepo = $devolucionRepo;
        $this->_productoRepo = $productoRepo;
        $this->_usersRepo = $usersRepo;
        $this->_invoicesRepo = $invoicesRepo;
    }

    public function index()
    {
        return view(
            'devolucion.index', [
                'model' => $this->_devolucionRepo->getAll()
            ]
        );
    }

    public function detail($id)
    {
        return view('devolucion.detail', [
            'model' => $this->_devolucionRepo->get($id)
        ]);
    }

    public function pdf($id)
    {
        $model = $this->_devolucionRepo->get($id);
        $devolucion_name = sprintf('notacredito-%s.pdf', str_pad ($model->id, 7, '0', STR_PAD_LEFT));

        $pdf = PDF::loadView('devolucion.pdf', [
            'model' => $model
        ]);

        return $pdf->download($devolucion_name);
    }
    

    public function add()
    {
        return view('devolucion.add');
    }

    public function save(Request $req)
    {
        $data = (object)[
          
            
            'iva' => $req->input('iva'),
            'subTotal' => $req->input('subTotal'),
            'total' => $req->input('total'),
            'invoice_id' => $req->input('invoice_id'),
            'user_id' => $req->input('user_id'),
            'detail' => []
        ];

        foreach($req->input('detail') as $d){
            $data->detail[] = (object)[
                'producto_id' => $d['id'],
                'cantidad'   => $d['cantidad'],
                'observacion'   => $d['observacion'],
                'precio_venta'  => $d['precio_venta'],
                'total'      => $d['total']
            ];
        }

        return $this->_devolucionRepo->save($data); 
    }

    public function findInvoice(Request $req)
    {
        return $this->_invoicesRepo
                    ->findByNumero($req->input('q'));
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
