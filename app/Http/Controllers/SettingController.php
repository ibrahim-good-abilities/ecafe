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
        $settings_list = [];
        $settings =  Setting::all();
        foreach ($settings as $field) {
            $settings_list[$field->name] = $field->value;
        }
        return view('settings')->with('settings',$settings_list);
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
            'company_phone' => 'required',
            'defualt_tax' => 'required'
        ]);

        if($request->has('company_name'))
        {
            Setting::where('name','company_name')->update(['value'=>request('company_name')]);
        }


        if($request->has('upload_logo'))
        {
            $image = $request->file('upload_logo');
            $name_img = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/logo/');
            $image->move($destinationPath, $name_img);
            $upload_logo = '/images/logo/'.$name_img;
            Setting::where('name','upload_logo')->update(['value'=>$upload_logo]);
        }

        if($request->has('company_phone'))
        {
            Setting::where('name','company_phone')->update(['value'=>request('company_phone')]);
        }

        if($request->has('defualt_tax'))
        {
            Setting::where('name','defualt_tax')->update(['value'=>request('defualt_tax')]);
        }
        $settings_list = [];
        $settings =  Setting::all();
        foreach ($settings as $field) {
            $settings_list[$field->name] = $field->value;
        }
        
        return redirect()->back()->with('settings',$settings_list)->with('success',__('Setting Done'));

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

    public static function getAll(){
        $settings_list = [];
        $settings =  Setting::all();
        foreach ($settings as $field) {
            $settings_list[$field->name] = $field->value;
        }
        return $settings_list;
    }
}
