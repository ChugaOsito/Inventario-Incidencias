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
        $rules = [
                'nombre' => 'required',
                'codigo' => 'required',
                
                    
            ];
        $messages = [
                'nombre.required'=>'El nombre es obligatorio',
                'codigo.required'=>'El codigo es obligatorio',
            ];
            
        $this->validate($request, $rules, $messages);

        request()->validate(Codigo::$rules);

        $codigo = Codigo::create($request->all());

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
}