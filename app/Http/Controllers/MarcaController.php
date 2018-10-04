<?php

namespace App\Http\Controllers;

use App\DataTables\MarcaDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateMarcaRequest;
use App\Http\Requests\UpdateMarcaRequest;
use App\Repositories\MarcaRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class MarcaController extends AppBaseController
{
    /** @var  MarcaRepository */
    private $marcaRepository;

    public function __construct(MarcaRepository $marcaRepo)
    {
        $this->marcaRepository = $marcaRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the Marca.
     *
     * @param MarcaDataTable $marcaDataTable
     * @return Response
     */
    public function index(MarcaDataTable $marcaDataTable)
    {
        return $marcaDataTable->render('marcas.index');
    }

    /**
     * Show the form for creating a new Marca.
     *
     * @return Response
     */
    public function create()
    {
        return view('marcas.create');
    }

    /**
     * Store a newly created Marca in storage.
     *
     * @param CreateMarcaRequest $request
     *
     * @return Response
     */
    public function store(CreateMarcaRequest $request)
    {
        $input = $request->all();

        $marca = $this->marcaRepository->create($input);

        Flash::success('Marca guardado exitosamente.');

        return redirect(route('marcas.index'));
    }

    /**
     * Display the specified Marca.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $marca = $this->marcaRepository->findWithoutFail($id);

        if (empty($marca)) {
            Flash::error('Marca no encontrado');

            return redirect(route('marcas.index'));
        }

        return view('marcas.show')->with('marca', $marca);
    }

    /**
     * Show the form for editing the specified Marca.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $marca = $this->marcaRepository->findWithoutFail($id);

        if (empty($marca)) {
            Flash::error('Marca no encontrado');

            return redirect(route('marcas.index'));
        }

        return view('marcas.edit')->with('marca', $marca);
    }

    /**
     * Update the specified Marca in storage.
     *
     * @param  int              $id
     * @param UpdateMarcaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMarcaRequest $request)
    {
        $marca = $this->marcaRepository->findWithoutFail($id);

        if (empty($marca)) {
            Flash::error('Marca no encontrado');

            return redirect(route('marcas.index'));
        }

        $marca = $this->marcaRepository->update($request->all(), $id);

        Flash::success('Marca actualizado exitosamente.');

        return redirect(route('marcas.index'));
    }

    /**
     * Remove the specified Marca from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $marca = $this->marcaRepository->findWithoutFail($id);

        if (empty($marca)) {
            Flash::error('Marca no encontrado');

            return redirect(route('marcas.index'));
        }

        $this->marcaRepository->delete($id);

        Flash::success('Marca eliminado exitosamente.');

        return redirect(route('marcas.index'));
    }
}
