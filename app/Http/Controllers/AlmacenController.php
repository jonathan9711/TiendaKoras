<?php

namespace App\Http\Controllers;

use App\almacen;
use Illuminate\Http\Request;

class AlmacenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function vistaAlmacen()
    {
        return view('admin.almacen');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function show(almacen $almacen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function edit(almacen $almacen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, almacen $almacen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function destroy(almacen $almacen)
    {
        //
    }
}
