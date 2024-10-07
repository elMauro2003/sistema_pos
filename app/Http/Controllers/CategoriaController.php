<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoria;
use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use App\Models\Caracteristica;
use App\Models\Categoria;
use Exception;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\LaravelIgnition\Http\Requests\UpdateConfigRequest;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::with('caracteristica')->latest()->get();
        return view('categoria.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoriaRequest $request /*Request $request*/)
    {

        // Lo que esta comentado es una alternativa bolivariana para manejar o evitar el try catch

        /*$request->validate([
            'nombre'=>'required|max:60|unique:caracteristicas,nombre',
            'descripcion'=>'nullable|max:255'
        ]);
        
        $caracteristica = new Caracteristica();
        $caracteristica->nombre = $request->nombre;
        $caracteristica->descripcion = $request->descripcion;
        $caracteristica->save();
        $categoria = new Categoria();
        $categoria->caracteristica_id = $caracteristica->id;
        $categoria->save();*/

        //
        //dd($request);
        try{
            DB::beginTransaction();
            $caracteristica = Caracteristica::create($request->validated());
            $caracteristica->categoria()->create([
                'caracteristica_id' => $caracteristica->id
            ]);
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route('categorias.index')
        ->with('success', 'Categoría registrada correctamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        return view('categoria.edit',['categoria'=>$categoria]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoriaRequest $request, Categoria $categoria)
    {
        Caracteristica::where('id', $categoria->caracteristica->id)
            ->update($request->validated());
        
        return redirect()->route('categorias.index')
            ->with('success', 'Categoría actualizada correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $categoria = Categoria::find($id);
        $message = '';
        if ($categoria->caracteristica->estado == 1){
            Caracteristica::where('id', $categoria->caracteristica->id)
            ->update([
                'estado' => 0
            ]);
            $message = 'Categoría eliminada correctamente!';
        }else{
            Caracteristica::where('id', $categoria->caracteristica->id)
            ->update([
                'estado' => 1
            ]);
            $message = 'Categoría restaurada correctamente!';
        }

        
        return redirect()->route('categorias.index')
            ->with('success', $message);
    }
}
