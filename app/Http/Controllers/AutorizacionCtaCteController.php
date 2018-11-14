<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAutorizacionCtaCteRequest;
use App\Http\Requests\UpdateAutorizacionCtaCteRequest;
use App\Repositories\AutorizacionCtaCteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Persona;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class AutorizacionCtaCteController extends AppBaseController
{
    /** @var  AutorizacionCtaCteRepository */
    private $autorizacionCtaCteRepository;

    public function __construct(AutorizacionCtaCteRepository $autorizacionCtaCteRepo)
    {
        $this->autorizacionCtaCteRepository = $autorizacionCtaCteRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the AutorizacionCtaCte.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->autorizacionCtaCteRepository->pushCriteria(new RequestCriteria($request));
        $autorizacionCtaCtes = $this->autorizacionCtaCteRepository->all();

        return view('autorizacionctactes.index')
            ->with('autorizacionCtaCtes', $autorizacionCtaCtes);
    }

    /**
     * Show the form for creating a new AutorizacionCtaCte.
     *
     * @return Response
     */
    public function create()
    {
      $personas = Persona::all();
       

      return view("autorizacionctactes.create", ["personas"=>$personas]);
        
    }

    /**
     * Store a newly created AutorizacionCtaCte in storage.
     *
     * @param CreateAutorizacionCtaCteRequest $request
     *
     * @return Response
     */
    public function store(CreateAutorizacionCtaCteRequest $request)
    {
        $input = $request->all();

        $autorizacionCtaCte = $this->autorizacionCtaCteRepository->create($input);

        Flash::success('Autorizacion Cta Cte guardado exitosamente.');

        return redirect(route('autorizacionctactes.index'));
    }

    /**
     * Display the specified AutorizacionCtaCte.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $autorizacionCtaCte = $this->autorizacionCtaCteRepository->findWithoutFail($id);

        if (empty($autorizacionCtaCte)) {
            Flash::error('Autorizacion Cta Cte no encontrado');

            return redirect(route('autorizacionctactes.index'));
        }

        return view('autorizacionctactes.show')->with('autorizacionCtaCte', $autorizacionCtaCte);
    }

    /**
     * Show the form for editing the specified AutorizacionCtaCte.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $autorizacionCtaCte = $this->autorizacionCtaCteRepository->findWithoutFail($id);

        if (empty($autorizacionCtaCte)) {
            Flash::error('Autorizacion Cta Cte no encontrado');

            return redirect(route('autorizacionctactes.index'));
        }

        return view('autorizacionctactes.edit')->with('autorizacionCtaCte', $autorizacionCtaCte);
    }

    /**
     * Update the specified AutorizacionCtaCte in storage.
     *
     * @param  int              $id
     * @param UpdateAutorizacionCtaCteRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAutorizacionCtaCteRequest $request)
    {
        $autorizacionCtaCte = $this->autorizacionCtaCteRepository->findWithoutFail($id);

        if (empty($autorizacionCtaCte)) {
            Flash::error('Autorizacion Cta Cte no encontrado');

            return redirect(route('autorizacionctactes.index'));
        }

        $autorizacionCtaCte = $this->autorizacionCtaCteRepository->update($request->all(), $id);

        Flash::success('Autorizacion Cta Cte actualizado exitosamente.');

        return redirect(route('autorizacionctactes.index'));
    }

    /**
     * Remove the specified AutorizacionCtaCte from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $autorizacionCtaCte = $this->autorizacionCtaCteRepository->findWithoutFail($id);

        if (empty($autorizacionCtaCte)) {
            Flash::error('Autorizacion Cta Cte no encontrado');

            return redirect(route('autorizacionctactes.index'));
        }

        $this->autorizacionCtaCteRepository->delete($id);

        Flash::success('Autorizacion Cta Cte eliminado exitosamente.');

        return redirect(route('autorizacionctactes.index'));
    }

     public function desactivar(Request $request)
    {
        
        $autorizacionCtaCte = AutorizacionCtaCte::findOrFail($request->id);
        $autorizacionCtaCte->condicion = '0';
        $autorizacionCtaCte->save();
         return redirect(route('autorizacionctactes.index'));
    }

    public function activar(Request $request)
    {
        
        $autorizacionCtaCte = AutorizacionCtaCte::findOrFail($request->id);
        $autorizacionCtaCte->condicion = '1';
        $autorizacionCtaCte->save();
         return redirect(route('autorizacionctactes.index'));
    }
}
