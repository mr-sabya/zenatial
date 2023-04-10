<?php

namespace App\Http\Controllers\Admin;

use Datatables;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;
use Cookie;

class BlogCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    //*** GET Request
    public function index(Request $request)
    {
        $cookie_value = Cookie::get('entries');
        $per_page = $request->get('entries', $cookie_value);

        if (!$per_page) {
            $per_page = 10;
        }        
        Cookie::queue('entries', $per_page);  
        $datas = BlogCategory::orderBy('id','desc')->get();        
        return view('admin.cblog.index', compact('datas', 'per_page'));
    }

    //*** GET Request
    public function create()
    {
        return view('admin.cblog.create');
    }

    //*** POST Request
    public function store(Request $request)
    {
        //--- Validation Section
        $rules = [
               'name' => 'unique:blog_categories',
               'slug' => 'unique:blog_categories'
                ];
        $customs = [
               'name.unique' => 'This name has already been taken.',
               'slug.unique' => 'This slug has already been taken.'
                   ];
        $validator = Validator::make(Input::all(), $rules, $customs);
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = new BlogCategory;
        $input = $request->all();
        $data->fill($input)->save();
        //--- Logic Section Ends

        //--- Redirect Section  
        $msg = 'New Data Added Successfully.';
        return redirect()->back()->with('success', $msg);      
        //--- Redirect Section Ends  
    }

    //*** GET Request
    public function edit($id)
    {
        $data = BlogCategory::findOrFail($id);
        return view('admin.cblog.edit',compact('data'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section
        $rules = [
               'name' => 'unique:blog_categories,name,'.$id,
               'slug' => 'unique:blog_categories,slug,'.$id
                ];
        $customs = [
               'name.unique' => 'This name has already been taken.',
               'slug.unique' => 'This slug has already been taken.'
                   ];
        $validator = Validator::make(Input::all(), $rules, $customs);
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = BlogCategory::findOrFail($id);
        $input = $request->all();
        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section          
        $msg = 'Data Updated Successfully.';
        return redirect()->back()->with('success', $msg);
        //--- Redirect Section Ends  

    }

    //*** GET Request
    public function destroy($id)
    {
        $data = BlogCategory::findOrFail($id);

        //--- Check If there any blogs available, If Available Then Delete it 
        if($data->blogs->count() > 0)
        {
            foreach ($data->blogs as $element) {
                $element->delete();
            }
        }
        $data->delete();
        //--- Redirect Section     
        $msg = 'Data Deleted Successfully.';
        return redirect()->back()->with('success', $msg);    
        //--- Redirect Section Ends   
    }
}
