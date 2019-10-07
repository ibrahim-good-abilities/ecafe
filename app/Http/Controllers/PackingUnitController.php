<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\PackingUnit;

class PackingUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = PackingUnit::all();
        return view('packing_units.index')->with('units',$units);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('packing_units.add-packing-unit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name'=>'required',
         ]);

        $packingUnit = new PackingUnit();
        $packingUnit->name = request('name');
        $packingUnit->save();
        return redirect()->route('packing-units.edit',$packingUnit->id)->with('success','Packing unit created successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
            $packingUnit = packingUnit::find($id);
            return view('packing_units.edit-packing-unit')->with('packingUnit',$packingUnit);
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
        $validator = $request->validate([
            'name'=>'required',
        ]);
        $packingUnit = packingUnit::find($id);
        $packingUnit->name = request('name');
        $packingUnit->save();

        return redirect()->back()->with('success','Packing unit updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $packingUnit = packingUnit::find($id);
        $packingUnit->delete();
        return redirect()->back()->with('success','packingUnit detelted successfully');
       
    }

}
