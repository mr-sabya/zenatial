<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Shipping;
use Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;

class ShippingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** GET Request
    public function index()
    {
        $datas = Shipping::all();
        return view('admin.shipping.index', compact('datas'));
    }

    //*** GET Request
    public function create()
    {
        $sign = Currency::where('is_default','=',1)->first();
        return view('admin.shipping.create',compact('sign'));
    }

    //*** POST Request
    public function store(Request $request)
    {
        //--- Validation Section
        $rules = ['title' => 'unique:shippings'];
        $customs = ['title.unique' => 'This title has already been taken.'];
        $validator = Validator::make(Input::all(), $rules, $customs);
        if ($validator->fails()) {
          return redirect()->back()->with('error',  $validator->getMessageBag()->toArray());    
        }
        //--- Validation Section Ends

        //--- Logic Section
        $sign = Currency::where('is_default','=',1)->first();
        $data = new Shipping();
        $input = $request->all();
        $input['price'] = ($input['price'] / $sign->value);
        $data->fill($input)->save();
        //--- Logic Section Ends

        //--- Redirect Section        
        $msg = 'New Data Added Successfully.';
        return redirect()->back()->with('success', $msg);
    }

    //*** GET Request
    public function edit($id)
    {
        $sign = Currency::where('is_default','=',1)->first();
        $data = Shipping::findOrFail($id);
        return view('admin.shipping.edit',compact('data','sign'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section
        $rules = ['title' => 'unique:shippings,title,'.$id];
        $customs = ['title.unique' => 'This title has already been taken.'];
        $validator = Validator::make(Input::all(), $rules, $customs);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }        
        //--- Validation Section Ends

        //--- Logic Section
        $sign = Currency::where('is_default','=',1)->first();
        $data = Shipping::findOrFail($id);
        $input = $request->all();
        $input['price'] = ($input['price'] / $sign->value);
        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section     
        $msg = 'Data Updated Successfully.';
        return redirect()->back()->with('success', $msg);      
        //--- Redirect Section Ends            
    }

    //*** GET Request Delete
    public function destroy($id)
    {
        $data = Shipping::findOrFail($id);
        $data->delete();
        //--- Redirect Section     
        $msg = 'Data Deleted Successfully.';
        return redirect()->back()->with('success', $msg);
        //--- Redirect Section Ends     
    }
}
