<?php

namespace App\Http\Controllers;

use App\Models\Codigo;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class CodigoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $codigos = Codigo::paginate();

        return view('codigo.index', compact('codigos'))
            ->with('i', (request()->input('page', 1) - 1) * $codigos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $codigos = Codigo::paginate();
        $codigo = new Codigo();
        return view('codigo.create', compact('codigo', 'codigos'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request->input('codigo')==null){
            $rules = [
                'nombre' => 'required|unique:codigos',



            ];
        $messages = [
                'nombre.required'=>'El nombre es obligatorio',
                'nombre.unique'=>'El nombre del bien ya existe',


            ];
        }else{
            $rules = [
                'nombre' => 'required|unique:codigos',
                'codigo'=> 'unique:codigos'


            ];
        $messages = [
                'nombre.required'=>'El nombre es obligatorio',
                'nombre.unique'=>'El nombre del bien ya existe',
                'codigo.unique'=>'El codigo del bien ya existe',

            ];
        }


        $this->validate($request, $rules, $messages);


if($request->input('codigo')==null){

    $code=$this->numerar();
}else{
    $code=$request->input('codigo');
}
$annex =new Codigo();
$annex->nombre= $request->input('nombre');
$annex->codigo= $code;

$annex->save();

        return redirect()->route('codigos/create')
            ->with('success', 'Modelo created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $codigo = Codigo::find($id);

        return view('codigo.edit', compact('codigo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $codigo = Codigo::find($id);
        $codigo->nombre = $request->input('nombre');
        $codigo->codigo = $request->input('codigo');
        $codigo->numero = $request->input('numero');
        $codigo->save();

        return back()->with('notification', 'Codigo modificado');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $codigo = Codigo::find($id)->delete();

        return redirect()->route('codigos/create')
            ->with('success', 'Modelo deleted successfully');
    }
    public function numerar(){

        $numero=Codigo::all()->count();

        $a=0;
            $numero=$numero-10;
            if($numero<=0){
                $numero=1;
            }
            while ($a = 1) {
               $consulta= Codigo::where('codigo','=',$numero)->count();

                if($consulta==0){
        $a=1;
        return $numero;
                }
                $numero=$numero+1;



            }
    }

}
