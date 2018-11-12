<?php

namespace App\Http\Controllers;

use App\DataTables\ProvinciaDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateProvinciaRequest;
use App\Http\Requests\UpdateProvinciaRequest;
use App\Repositories\ProvinciaRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\Localidad;
use Response;

class ProvinciaController extends AppBaseController
{
    /** @var  ProvinciaRepository */
    private $provinciaRepository;

    public function __construct(ProvinciaRepository $provinciaRepo)
    {
        $this->provinciaRepository = $provinciaRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the Provincia.
     *
     * @param ProvinciaDataTable $provinciaDataTable
     * @return Response
     */
    public function index(ProvinciaDataTable $provinciaDataTable)
    {
        return $provinciaDataTable->render('provincias.index');
    }

    /**
     * Show the form for creating a new Provincia.
     *
     * @return Response
     */
    public function create()
    {

      $localidades = Localidad::all();
      return view("provincias.create", ["localidades"=>$localidades]);
    
    }

    /**
     * Store a newly created Provincia in storage.
     *
     * @param CreateProvinciaRequest $request
     *
     * @return Response
     */
    public function store(CreateProvinciaRequest $request)
    {
        $input = $request->all();

        $provincia = $this->provinciaRepository->create($input);

        Flash::success('Provincia guardado exitosamente.');

        return redirect(route('provincias.index'));
    }

    /**
     * Display the specified Provincia.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $provincia = $this->provinciaRepository->findWithoutFail($id);

        if (empty($provincia)) {
            Flash::error('Provincia no encontrado');

            return redirect(route('provincias.index'));
        }

        return view('provincias.show')->with('provincia', $provincia);
    }

    /**
     * Show the form for editing the specified Provincia.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $provincia = $this->provinciaRepository->findWithoutFail($id);

        if (empty($provincia)) {
            Flash::error('Provincia no encontrado');

            return redirect(route('provincias.index'));
        }

        return view('provincias.edit')->with('provincia', $provincia);
    }

    /**
     * Update the specified Provincia in storage.
     *
     * @param  int              $id
     * @param UpdateProvinciaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProvinciaRequest $request)
    {
        $provincia = $this->provinciaRepository->findWithoutFail($id);

        if (empty($provincia)) {
            Flash::error('Provincia no encontrado');

            return redirect(route('provincias.index'));
        }

        $provincia = $this->provinciaRepository->update($request->all(), $id);

        Flash::success('Provincia actualizado exitosamente.');

        return redirect(route('provincias.index'));
    }

    /**
     * Remove the specified Provincia from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $provincia = $this->provinciaRepository->findWithoutFail($id);

        if (empty($provincia)) {
            Flash::error('Provincia no encontrado');

            return redirect(route('provincias.index'));
        }

        $this->provinciaRepository->delete($id);

        Flash::success('Provincia eliminado exitosamente.');

        return redirect(route('provincias.index'));
    }
}
