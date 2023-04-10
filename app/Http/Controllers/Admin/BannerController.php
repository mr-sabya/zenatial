<?php

namespace App\Http\Controllers\Admin;

use Datatables;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables($type)
    {
         $datas = Banner::where('type','=',$type)->orderBy('id','desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->editColumn('photo', function(Banner $data) {
                                $photo = $data->photo ? url('assets/images/banners/'.$data->photo):url('assets/images/noimage.png');
                                return '<img src="' . $photo . '" alt="Image">';
                            })
                            ->addColumn('action', function(Banner $data) {
                                return '<div class="action-list"><a data-href="' . route('admin-sb-edit',$data->id) . '" class="edit" data-toggle="modal" data-target="#modal1"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="' . route('admin-sb-delete',$data->id) . '" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                            }) 
                            ->rawColumns(['photo', 'action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index($type)
    {
        $type2 = '';
        if($type == 'nav-banner'){
            $type2 = 'Mainnav';
        }elseif($type == 'under-slider'){
            $type2 = 'UnderSlider';
        }elseif($type == 'under-slider'){
            $type2 = 'UnderSlider';
        }elseif($type == 'large'){
            $type2 = 'Large';
        }elseif($type == 'weekly-deal'){
            $type2 = 'WeeklyDeal';
        }
        $datas = Banner::where('type','=',$type2)->orderBy('id','desc')->get();
        return view('admin.banner.index', compact('datas', 'type', 'type2'));
    }

    //*** GET Request
    public function create($type)
    {
        $type2 = '';
        if($type == 'nav-banner'){
            $type2 = 'Mainnav';
        }elseif($type == 'under-slider'){
            $type2 = 'UnderSlider';
        }elseif($type == 'under-slider'){
            $type2 = 'UnderSlider';
        }elseif($type == 'large'){
            $type2 = 'Large';
        }elseif($type == 'weekly-deal'){
            $type2 = 'WeeklyDeal';
        }
        return view('admin.banner.create', compact('type', 'type2'));
    }

    //*** POST Request
    public function store(Request $request)
    {
        //--- Validation Section
        $rules = [
               'photo'      => 'required|mimes:jpeg,jpg,png,svg',
                ];

        $validator = Validator::make(Input::all(), $rules);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = new Banner();
        $input = $request->all();
        print_r($input);
        if ($file = $request->file('photo')) 
         {      
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images/banners',$name);           
            $input['photo'] = $name;
        } 

        //$data->fill($input)->save();
        $data->create($input);
        //--- Logic Section Ends

        //--- Redirect Section        
        $msg = 'New Data Added Successfully.';
        return redirect()->back()->with('success', $msg);
        //--- Redirect Section Ends    
    }

    //*** GET Request
    public function edit($id)
    {        
        $data = Banner::findOrFail($id);
        return view('admin.banner.edit',compact('data', 'type2'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section
        $rules = [
               'photo'      => 'mimes:jpeg,jpg,png,svg',
                ];

        $validator = Validator::make(Input::all(), $rules);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = Banner::findOrFail($id);
        $input = $request->all();
            if ($file = $request->file('photo')) 
            {              
                $name = time().$file->getClientOriginalName();
                $file->move('assets/images/banners',$name);
                if($data->photo != null)
                {
                    if (file_exists(public_path().'/assets/images/banners/'.$data->photo)) {
                        unlink(public_path().'/assets/images/banners/'.$data->photo);
                    }
                }            
            $input['photo'] = $name;
            } 
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
        $data = Banner::findOrFail($id);
        //If Photo Doesn't Exist
        if($data->photo == null){
            $data->delete();
            //--- Redirect Section     
            $msg = 'Data Deleted Successfully.';
            return response()->json($msg);      
            //--- Redirect Section Ends     
        }
        //If Photo Exist
        if (file_exists(public_path().'/assets/images/banners/'.$data->photo)) {
            unlink(public_path().'/assets/images/banners/'.$data->photo);
        }
        $data->delete();
        //--- Redirect Section     
        $msg = 'Data Deleted Successfully.';
        return redirect()->back()->with('success', $msg);      
        //--- Redirect Section Ends     
    }
}
