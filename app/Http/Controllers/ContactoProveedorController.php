<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContactoProveedorRequest;
use App\Http\Requests\UpdateContactoProveedorRequest;
use App\Repositories\ContactoProveedorRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\ContactoProveedor;
use App\Models\Proveedor;
use App\Models\Cliente;
use App\Models\TipoContacto; 

class ContactoProveedorController extends AppBaseController
{
    /** @var  ContactoProveedorRepository */
    private $contactoProveedorRepository;

    public function __construct(ContactoProveedorRepository $contactoProveedorRepo)
    {
        $this->contactoProveedorRepository = $contactoProveedorRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the ContactoProveedor.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->contactoProveedorRepository->pushCriteria(new RequestCriteria($request));
        $contactoProveedors = $this->contactoProveedorRepository->all();

        return view('contacto_proveedores.index')
            ->with('contactoProveedors', $contactoProveedors);
    }

    /**
     * Show the form for creating a new ContactoProveedor.
     *
     * @return Response
     */
    public function create()
    {
         $proveedores = Proveedor::all();
         $tipocontactos=TipoContacto::all(); 

      return view("contacto_proveedores.create", ["proveedores"=>$proveedores,"tipocontactos"=>$tipocontactos]);
    
    }

    /**
     * Store a newly created ContactoProveedor in storage.
     *
     * @param CreateContactoProveedorRequest $request
     *
     * @return Response
     */
    public function store(CreateContactoProveedorRequest $request)
    {
        $input = $request->all();

        $contactoProveedor = $this->contactoProveedorRepository->create($input);

        Flash::success('Contacto Proveedor guardado exitosamente.');

        return redirect(route('contacto_proveedores.index'));
    }

    /**
     * Display the specified ContactoProveedor.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $contactoProveedor = $this->contactoProveedorRepository->findWithoutFail($id);

        if (empty($contactoProveedor)) {
            Flash::error('Contacto Proveedor no encontrado');

            return redirect(route('contacto_proveedores.index'));
        }

        return view('contacto_proveedores.show')->with('contactoProveedor', $contactoProveedor);
    }

    /**
     * Show the form for editing the specified ContactoProveedor.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $contactoProveedor = $this->contactoProveedorRepository->findWithoutFail($id);

        if (empty($contactoProveedor)) {
            Flash::error('Contacto Proveedor no encontrado');

            return redirect(route('contacto_proveedores.index'));
        }

        $contacto_proveedores =ContactoProveedor::find($id);
        $proveedores= Proveedor::all();
        $tipocontactos=TipoContacto::all();
      
      return view ("contacto_proveedores.edit",["contacto_proveedores"=>$contacto_proveedores,"proveedores"=>$proveedores,'tipocontactos'=>$tipocontactos]);

        return view('contacto_proveedores.edit')->with('contactoProveedor', $contactoProveedor);
    }

    /**
     * Update the specified ContactoProveedor in storage.
     *
     * @param  int              $id
     * @param UpdateContactoProveedorRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateContactoProveedorRequest $request)
    {
        $contactoProveedor = $this->contactoProveedorRepository->findWithoutFail($id);

        if (empty($contactoProveedor)) {
            Flash::error('Contacto Proveedor no encontrado');

            return redirect(route('contacto_proveedores.index'));
        }

        $contactoProveedor = $this->contactoProveedorRepository->update($request->all(), $id);

        Flash::success('Contacto Proveedor actualizado exitosamente.');

        return redirect(route('contacto_proveedores.index'));
    }

    /**
     * Remove the specified ContactoProveedor from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $contactoProveedor = $this->contactoProveedorRepository->findWithoutFail($id);

        if (empty($contactoProveedor)) {
            Flash::error('Contacto Proveedor no encontrado');

            return redirect(route('contacto_proveedores.index'));
        }

        $this->contactoProveedorRepository->delete($id);

        Flash::success('Contacto Proveedor eliminado exitosamente.');

        return redirect(route('contacto_proveedores.index'));
    }
}
