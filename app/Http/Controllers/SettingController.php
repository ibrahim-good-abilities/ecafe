<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Setting;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function settings()
    {

        return view('settings');
    }
    public function index()
    {
        //
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

        $request->validate([
            'company_name' => 'required',
            'upload_logo' => 'required',
            'company_phone' => 'required',
            'defualt_tax' => 'required'
        ]);

        if($request->has('company_name'))
        {
            Setting::updateOrCreate(['name'=>'company_name','value'=>request('company_name')]);
        }
        $image = $request->file('upload_logo');
        $name_img = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/images/logo/');
        $image->move($destinationPath, $name_img);
        $upload_logo = '/images/categories/'.$name_img;
        if($request->has('upload_logo'))
        {
            Setting::updateOrCreate(['name'=>'upload_logo','value'=>$upload_logo]);
        }
        if($request->has('company_phone'))
        {
            Setting::updateOrCreate(['name'=>'company_phone','value'=>request('company_phone')]);
        }
        if($request->has('defualt_tax'))
        {
            Setting::updateOrCreate(['name'=>'defualt_tax','value'=>request('defualt_tax')]);
        }

        return redirect()->back()->with('success',__('Setting Done'));

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
