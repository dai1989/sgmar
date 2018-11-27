<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Persona; 
use App\DataTables\ClienteDataTable;
use App\Repositories\ClienteRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Flash;
class ClienteController extends Controller
{
   private $ClienteRepository;

    public function __construct(ClienteRepository $clienteRepo)
    {
        $this->ClienteRepository = $clienteRepo;
    }
   public function index(ClienteDataTable $clienteDataTable)
    {
       $clientes_list= Cliente::all ();
        return $clienteDataTable->render('clientes.index',["clientes_list"=> $clientes_list]);
       
    }
   
     
    
    public function create()
    {
      return view("clientes.create");
    }
    public function store(Request $request)
    {
      $nombre = $request->input ("Nombre");
      $apellido = $request->input ("Apellido");
      $documento = $request->input("Documento");
      $fechaNacimiento = $request->input("FechaNacimiento");
      $genero = $request->input("Genero");
      /*$tipo_documento = $request->input("cboTipoDocumento");*/
       request()->validate ([
          'Nombre' => 'required',
          'Apellido' => 'required',
          'Documento' => 'required|unique:personas',
          'FechaNacimiento' => 'required',
          'Genero' => 'required',

        ]);

      $persona = new Persona ();
      $persona->nombre =$nombre;
      $persona->apellido =$apellido;
      $persona->documento =$documento;
      $persona->fecha_nacimiento =$fechaNacimiento;
      $persona->genero =$genero;
      /*$persona->tipodocumento_id =$tipo_documento;*/
      $persona-> save();

      $cliente = new Cliente (); 
      $cliente->persona_id= $persona->id;
      $cliente->save();

       Flash::success('Cliente guardado exitosamente.');

     return redirect(route('clientes.index'));


    }
    public function show($id)
    {
      $cliente = Cliente::find($id);

      return view ("clientes.show",["cliente"=>$cliente]);
    }
    public function destroy ($id)
    {
      $cliente = Cliente::find($id);
      $persona = $cliente->persona;
      $cliente->delete();
      $persona->delete();

      Flash::success('Cliente eliminado exitosamente.');

        return redirect(route('clientes.index'));
        
    }
    public function edit($id) 
    {
      $cliente =Cliente::find($id);
      return view ("clientes.edit",["cliente"=>$cliente]);

    }
    public function update (Request $request, $id)
    {
      //obtener datos del formulario
      $nombre = $request->input ("Nombre");
      $apellido = $request->input ("Apellido");
      $documento = $request->input("Documento");
      $fechaNacimiento = $request->input("FechaNacimiento");
      $genero = $request->input("Genero");
      /*$tipo_documento = $request->input("cboTipoDocumento");*/
       request()->validate ([
          'Nombre' => 'required',
          'Apellido' => 'required',
          'Documento' => 'required',
          'FechaNacimiento' => 'required', 
          'Genero' => 'required',

        ]);
      

      //obtener el cliente a modificar
      $cliente = Cliente::find($id);

      //asignar datos al cliente
      $cliente->persona->nombre=$nombre;
      $cliente->persona->apellido=$apellido;
      $cliente->persona->documento=$documento;
      $cliente->persona->fecha_nacimiento=$fechaNacimiento;
      $cliente->persona->genero=$genero;
      /*$cliente->persona->tipo_documento=$tipo_documento;*/
      
      $cliente->persona->save();
      //$cliente->save();

      
       Flash::success('Cliente actualizado exitosamente.');

        return redirect(route('clientes.index'));

    }
}

