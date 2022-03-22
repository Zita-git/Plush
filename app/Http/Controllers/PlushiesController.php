<?php

namespace App\Http\Controllers;

use App\Models\Plushies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlushiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plushies = Plushies::orderBy('name')->get();
        return view('plushies.index', [ 'plushies' => $plushies ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plushies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $adatok = $request->only(['name']);
        $plush = new Plushies();
        $plush->fill($adatok);
        $plush->save();
        return redirect()->route('plushies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plushies  $plushies
     * @return \Illuminate\Http\Response
     */
    public function show(Plushies $plushies)
    {
        return view('plushies.show', ['plush' => $plushies]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Plushies  $plushies
     * @return \Illuminate\Http\Response
     */
    public function edit(Plushies $plushies)
    {
        return view('plushies.edit', ['plush' => $plushies]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plushies  $plushies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plushies $plushies)
    {
        $adatok = $request->only(['person', 'height', 'pricename']);
        $plushies->fill($adatok);
        $plushies->save();
        return redirect()->route('plushies.show', $plushies->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plushies  $plushies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plushies $plushies)
    {
        $plushies->delete();
        return redirect()->route('plushies.index');
    }
}
