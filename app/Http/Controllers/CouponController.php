<?php

namespace App\Http\Controllers;
use App\Coupon;

use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $coupons = Coupon::all();
        return   view('coupons.index')->with('coupons',$coupons);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('coupons.add');
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
        $validator=$request->validate([
               'coupon_Name'    =>'required',
               'coupon_code'    =>'required',
               'value'          =>'required',
               'type'           =>'required',
               'status'         =>'required',
               'coupon_date'    =>'required'
        ]);
        $coupon = new coupon();
        $coupon->name = request('coupon_Name');
        $coupon->code =request('coupon_code');
        $coupon->value=request('value');
        $coupon->type=request('type');
        $coupon->status=request('status');
        $coupon->expiry_date=request('coupon_date');
        $coupon->save();
        return view('coupons.edit')->with('coupon',$coupon)->with('success',__('coupon created successfully'));

        //return redirect()->back()->with('success','coupon created successfully');
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
        $coupon = Coupon::find($id);
        return view('coupons.edit')->with('coupon',$coupon);
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
        $validator=$request->validate([
            'coupon_Name'    =>'required',
            'coupon_code'    =>'required',
            'value'          =>'required',
            'type'           =>'required',
            'status'         =>'required',
            'coupon_date'    =>'required'
     ]);
     $coupon = Coupon::find($id);
     $coupon->name = request('coupon_Name');
        $coupon->code =request('coupon_code');
        $coupon->value=request('value');
        $coupon->type=request('type');
        $coupon->status=request('status');
        $coupon->expiry_date=request('coupon_date');
        $coupon->save();
        return view('coupons.edit')->with('coupon',$coupon)->with('success',__('coupon updated successfully'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();
        return redirect()->back()->with('success', __('item deleted successfully'));
    }
}
