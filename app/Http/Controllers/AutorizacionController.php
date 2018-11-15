<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAutorizacionRequest;
use App\Http\Requests\UpdateAutorizacionRequest;
use App\Repositories\AutorizacionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class AutorizacionController extends AppBaseController
{
    /** @var  AutorizacionRepository */
    private $autorizacionRepository;

    public function __construct(AutorizacionRepository $autorizacionRepo)
    {
        $this->autorizacionRepository = $autorizacionRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the Autorizacion.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->autorizacionRepository->pushCriteria(new RequestCriteria($request));
        $autorizacions = $this->autorizacionRepository->all();

        return view('autorizacions.index')
            ->with('autorizacions', $autorizacions);
    }

    /**
     * Show the form for creating a new Autorizacion.
     *
     * @return Response
     */
    public function create()
    {
        return view('autorizacions.create');
    }

    /**
     * Store a newly created Autorizacion in storage.
     *
     * @param CreateAutorizacionRequest $request
     *
     * @return Response
     */
    public function store(CreateAutorizacionRequest $request)
    {
        $input = $request->all();

        $autorizacion = $this->autorizacionRepository->create($input);

        Flash::success('Autorizacion guardado exitosamente.');

        return redirect(route('autorizacions.index'));
    }

    /**
     * Display the specified Autorizacion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $autorizacion = $this->autorizacionRepository->findWithoutFail($id);

        if (empty($autorizacion)) {
            Flash::error('Autorizacion no encontrado');

            return redirect(route('autorizacions.index'));
        }

        return view('autorizacions.show')->with('autorizacion', $autorizacion);
    }

    /**
     * Show the form for editing the specified Autorizacion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $autorizacion = $this->autorizacionRepository->findWithoutFail($id);

        if (empty($autorizacion)) {
            Flash::error('Autorizacion no encontrado');

            return redirect(route('autorizacions.index'));
        }

        return view('autorizacions.edit')->with('autorizacion', $autorizacion);
    }

    /**
     * Update the specified Autorizacion in storage.
     *
     * @param  int              $id
     * @param UpdateAutorizacionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAutorizacionRequest $request)
    {
        $autorizacion = $this->autorizacionRepository->findWithoutFail($id);

        if (empty($autorizacion)) {
            Flash::error('Autorizacion no encontrado');

            return redirect(route('autorizacions.index'));
        }

        $autorizacion = $this->autorizacionRepository->update($request->all(), $id);

        Flash::success('Autorizacion actualizado exitosamente.');

        return redirect(route('autorizacions.index'));
    }

    /**
     * Remove the specified Autorizacion from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $autorizacion = $this->autorizacionRepository->findWithoutFail($id);

        if (empty($autorizacion)) {
            Flash::error('Autorizacion no encontrado');

            return redirect(route('autorizacions.index'));
        }

        $this->autorizacionRepository->delete($id);

        Flash::success('Autorizacion eliminado exitosamente.');

        return redirect(route('autorizacions.index'));
    }
}
