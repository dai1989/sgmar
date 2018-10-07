<?php

namespace App\Http\Controllers;

use App\Repositories\ProductoRepository;
use Illuminate\Http\Request,
    App\Repositories\PersonaRepository,
    App\Repositories\InvoiceRepository,
    App\Http\Requests,
    PDF;

class InvoiceController extends Controller
{
    private $_personaRepo;
    private $_productoRepo;
    private $_invoiceRepo;

    public function __CONSTRUCT(
        PersonaRepository $personaRepo,
        ProductoRepository $productoRepo,
        InvoiceRepository $invoiceRepo
    )
    {
        $this->_personaRepo = $personaRepo;
        $this->_productoRepo = $productoRepo;
        $this->_invoiceRepo = $invoiceRepo;
    }

    public function index()
    {
        return view(
            'invoice.index', [
                'model' => $this->_invoiceRepo->getAll()
            ]
        );
    }

    public function detail($id)
    {
        return view('invoice.detail', [
            'model' => $this->_invoiceRepo->get($id)
        ]);
    }

    public function pdf($id)
    {
        $model = $this->_invoiceRepo->get($id);
        $invoice_name = sprintf('comprobante-%s.pdf', str_pad ($model->id, 7, '0', STR_PAD_LEFT));

        $pdf = PDF::loadView('invoice.pdf', [
            'model' => $model
        ]);

        return $pdf->download($invoice_name);
    }

    public function add()
    {
        return view('invoice.add');
    }

    public function save(Request $req)
    {
        $data = (object)[
            'iva' => $req->input('iva'),
            'subTotal' => $req->input('subTotal'),
            'total' => $req->input('total'),
            'persona_id' => $req->input('persona_id'),
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

        return $this->_invoiceRepo->save($data);
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
