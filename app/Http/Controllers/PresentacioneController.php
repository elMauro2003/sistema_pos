<?php

namespace App\Http\Controllers;

use App\Models\Presentacione;
use Illuminate\Http\Request;

class PresentacioneController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:ver-presentacione|crear-presentacione|editar-presentacione|eliminar-presentacione', ['only' => ['index']]);
        $this->middleware('permission:crear-presentacione', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-presentacione', ['only' => ['edit', 'update']]);
        $this->middleware('permission:eliminar-presentacione', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Presentacione $presentacione)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Presentacione $presentacione)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Presentacione $presentacione)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Presentacione $presentacione)
    {
        //
    }
}
