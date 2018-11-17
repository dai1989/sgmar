<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTipoDomicilioRequest;
use App\Http\Requests\UpdateTipoDomicilioRequest;
use App\Repositories\TipoDomicilioRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class TipoDomicilioController extends AppBaseController
{
    /** @var  TipoDomicilioRepository */
    private $tipoDomicilioRepository;

    public function __construct(TipoDomicilioRepository $tipoDomicilioRepo)
    {
        $this->tipoDomicilioRepository = $tipoDomicilioRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the TipoDomicilio.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->tipoDomicilioRepository->pushCriteria(new RequestCriteria($request));
        $tipoDomicilios = $this->tipoDomicilioRepository->all();

        return view('tipo_domicilios.index')
            ->with('tipoDomicilios', $tipoDomicilios);
    }

    /**
     * Show the form for creating a new TipoDomicilio.
     *
     * @return Response
     */
    public function create()
    {
        return view('tipo_domicilios.create');
    }

    /**
     * Store a newly created TipoDomicilio in storage.
     *
     * @param CreateTipoDomicilioRequest $request
     *
     * @return Response
     */
    public function store(CreateTipoDomicilioRequest $request)
    {
        $input = $request->all();

        $tipoDomicilio = $this->tipoDomicilioRepository->create($input);

        Flash::success('Tipo Domicilio guardado exitosamente.');

        return redirect(route('tipoDomicilios.index'));
    }

    /**
     * Display the specified TipoDomicilio.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tipoDomicilio = $this->tipoDomicilioRepository->findWithoutFail($id);

        if (empty($tipoDomicilio)) {
            Flash::error('Tipo Domicilio no encontrado');

            return redirect(route('tipoDomicilios.index'));
        }

        return view('tipo_domicilios.show')->with('tipoDomicilio', $tipoDomicilio);
    }

    /**
     * Show the form for editing the specified TipoDomicilio.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tipoDomicilio = $this->tipoDomicilioRepository->findWithoutFail($id);

        if (empty($tipoDomicilio)) {
            Flash::error('Tipo Domicilio no encontrado');

            return redirect(route('tipoDomicilios.index'));
        }

        return view('tipo_domicilios.edit')->with('tipoDomicilio', $tipoDomicilio);
    }

    /**
     * Update the specified TipoDomicilio in storage.
     *
     * @param  int              $id
     * @param UpdateTipoDomicilioRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTipoDomicilioRequest $request)
    {
        $tipoDomicilio = $this->tipoDomicilioRepository->findWithoutFail($id);

        if (empty($tipoDomicilio)) {
            Flash::error('Tipo Domicilio no encontrado');

            return redirect(route('tipoDomicilios.index'));
        }

        $tipoDomicilio = $this->tipoDomicilioRepository->update($request->all(), $id);

        Flash::success('Tipo Domicilio actualizado exitosamente.');

        return redirect(route('tipoDomicilios.index'));
    }

    /**
     * Remove the specified TipoDomicilio from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tipoDomicilio = $this->tipoDomicilioRepository->findWithoutFail($id);

        if (empty($tipoDomicilio)) {
            Flash::error('Tipo Domicilio no encontrado');

            return redirect(route('tipoDomicilios.index'));
        }

        $this->tipoDomicilioRepository->delete($id);

        Flash::success('Tipo Domicilio eliminado exitosamente.');

        return redirect(route('tipoDomicilios.index'));
    }
}
