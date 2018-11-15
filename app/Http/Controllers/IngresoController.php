<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateIngresoRequest;
use App\Http\Requests\UpdateIngresoRequest;
use App\Repositories\IngresoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Ingreso;
use App\User;
use App\Models\Autorizacion;
use App\Models\Credito;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class IngresoController extends AppBaseController
{
    /** @var  IngresoRepository */
    private $ingresoRepository;

    public function __construct(IngresoRepository $ingresoRepo)
    {
        $this->ingresoRepository = $ingresoRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the Ingreso.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->ingresoRepository->pushCriteria(new RequestCriteria($request));
        $ingresos = $this->ingresoRepository->all();

        return view('ingresos.index')
            ->with('ingresos', $ingresos);
    }

    /**
     * Show the form for creating a new Ingreso.
     *
     * @return Response
     */
    public function create()
    {
      $user_list = User::all();
      $autorizacion_list = Autorizacion::all();
      $credito_list = Credito::all();
      return view("ingresos.create", ["user_list"=>$user_list,"autorizacion_list"=>$autorizacion_list,"credito_list"=>$credito_list]);
        
    }

    /**
     * Store a newly created Ingreso in storage.
     *
     * @param CreateIngresoRequest $request
     *
     * @return Response
     */
    public function store(CreateIngresoRequest $request)
    {
        $input = $request->all();

        $ingreso = $this->ingresoRepository->create($input);

        Flash::success('Ingreso guardado exitosamente.');

        return redirect(route('ingresos.index'));
    }

    /**
     * Display the specified Ingreso.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $ingreso = $this->ingresoRepository->findWithoutFail($id);

        if (empty($ingreso)) {
            Flash::error('Ingreso no encontrado');

            return redirect(route('ingresos.index'));
        }

        return view('ingresos.show')->with('ingreso', $ingreso);
    }

    /**
     * Show the form for editing the specified Ingreso.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $ingreso = $this->ingresoRepository->findWithoutFail($id);

        if (empty($ingreso)) {
            Flash::error('Ingreso no encontrado');

            return redirect(route('ingresos.index'));
        }

        return view('ingresos.edit')->with('ingreso', $ingreso);
    }

    /**
     * Update the specified Ingreso in storage.
     *
     * @param  int              $id
     * @param UpdateIngresoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateIngresoRequest $request)
    {
        $ingreso = $this->ingresoRepository->findWithoutFail($id);

        if (empty($ingreso)) {
            Flash::error('Ingreso no encontrado');

            return redirect(route('ingresos.index'));
        }

        $ingreso = $this->ingresoRepository->update($request->all(), $id);

        Flash::success('Ingreso actualizado exitosamente.');

        return redirect(route('ingresos.index'));
    }

    /**
     * Remove the specified Ingreso from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $ingreso = $this->ingresoRepository->findWithoutFail($id);

        if (empty($ingreso)) {
            Flash::error('Ingreso no encontrado');

            return redirect(route('ingresos.index'));
        }

        $this->ingresoRepository->delete($id);

        Flash::success('Ingreso eliminado exitosamente.');

        return redirect(route('ingresos.index'));
    }
}
