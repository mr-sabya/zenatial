<?php

namespace App\Http\Controllers\Admin;

use Datatables;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;
use Cookie;

class CategoryController extends Controller
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
        $datas = Category::orderBy('id','desc')->paginate($per_page);
        return view('admin.category.index', compact('datas', 'per_page'));
    }

    //*** GET Request
    public function create()
    {
        return view('admin.category.create');
    }

    //*** POST Request
    public function store(Request $request)
    {
        //--- Validation Section
        $rules = [
            'photo' => 'mimes:jpeg,jpg,png,svg',
            'slug' => 'unique:categories|regex:/^[a-zA-Z0-9\s-]+$/'
                 ];
        $customs = [
            'photo.mimes' => 'Icon Type is Invalid.',
            'slug.unique' => 'This slug has already been taken.',
            'slug.regex' => 'Slug Must Not Have Any Special Characters.'
                   ];
        $validator = Validator::make(Input::all(), $rules, $customs);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = new Category();
        $input = $request->all();
        if ($file = $request->file('photo'))
         {
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images/categories',$name);
            $input['photo'] = $name;
        }
        if ($request->is_featured == ""){
            $input['is_featured'] = 0;
        }
        else {
                $input['is_featured'] = 1;
                //--- Validation Section
                $rules = [
                    'image' => 'required|mimes:jpeg,jpg,png,svg'
                        ];
                $customs = [
                    'image.required' => 'Feature Image is required.',
                    'image.mimes' => 'Feature Image Type is Invalid.'
                        ];
                $validator = Validator::make(Input::all(), $rules, $customs);

                if ($validator->fails()) {
                return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
                }
                //--- Validation Section Ends
                if ($file = $request->file('image'))
                {
                   $name = time().$file->getClientOriginalName();
                   $file->move('assets/images/categories',$name);
                   $input['image'] = $name;
                }
        }
        $data->fill($input)->save();
        //--- Logic Section Ends

        //--- Redirect Section
        $msg = 'New Data Added Successfully.';
        return response()->json($msg);
        //--- Redirect Section Ends
    }

    //*** GET Request
    public function edit($id)
    {
        $data = Category::findOrFail($id);
        return view('admin.category.edit',compact('data'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section
        $rules = [
        	'photo' => 'mimes:jpeg,jpg,png,svg',
        	'slug' => 'unique:categories,slug,'.$id.'|regex:/^[a-zA-Z0-9\s-]+$/'
        		 ];
        $customs = [
        	'photo.mimes' => 'Icon Type is Invalid.',
        	'slug.unique' => 'This slug has already been taken.',
            'slug.regex' => 'Slug Must Not Have Any Special Characters.'
        		   ];
        $validator = Validator::make(Input::all(), $rules, $customs);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = Category::findOrFail($id);
        $input = $request->all();
            if ($file = $request->file('photo'))
            {
                $name = time().$file->getClientOriginalName();
                $file->move('assets/images/categories',$name);
                if($data->photo != null)
                {
                    if (file_exists(public_path().'/assets/images/categories/'.$data->photo)) {
                        unlink(public_path().'/assets/images/categories/'.$data->photo);
                    }
                }
            $input['photo'] = $name;
            }

            if ($request->is_featured == ""){
                $input['is_featured'] = 0;
            }
            else {
                    $input['is_featured'] = 1;
                    //--- Validation Section
                    $rules = [
                        'image' => 'mimes:jpeg,jpg,png,svg'
                            ];
                    $customs = [
                        'image.required' => 'Feature Image is required.'
                            ];
                    $validator = Validator::make(Input::all(), $rules, $customs);

                    if ($validator->fails()) {
                    return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
                    }
                    //--- Validation Section Ends
                    if ($file = $request->file('image'))
                    {
                       $name = time().$file->getClientOriginalName();
                       $file->move('assets/images/categories',$name);
                       $input['image'] = $name;
                    }
            }

        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);
        //--- Redirect Section Ends
    }

      //*** GET Request Status
      public function status($id1,$id2)
      {
          $data = Category::findOrFail($id1);
          $data->status = $id2;
          $data->update();
      }


    //*** GET Request Delete
    public function destroy($id)
    {
        $data = Category::findOrFail($id);

        if($data->attributes->count() > 0)
        {
        //--- Redirect Section
        $msg = 'Remove the Attributes first !';
        return response()->json($msg);
        //--- Redirect Section Ends
        }

        if($data->subs->count()>0)
        {
        //--- Redirect Section
        $msg = 'Remove the subcategories first !';
        return response()->json($msg);
        //--- Redirect Section Ends
        }
        if($data->products->count()>0)
        {
        //--- Redirect Section
        $msg = 'Remove the products first !';
        return response()->json($msg);
        //--- Redirect Section Ends
        }


        //If Photo Doesn't Exist
        if($data->photo == null){
            $data->delete();
            //--- Redirect Section
            $msg = 'Data Deleted Successfully.';
            return response()->json($msg);
            //--- Redirect Section Ends
        }
        //If Photo Exist
        if (file_exists(public_path().'/assets/images/categories/'.$data->photo)) {
            unlink(public_path().'/assets/images/categories/'.$data->photo);
        }
        if (file_exists(public_path().'/assets/images/categories/'.$data->image)) {
            unlink(public_path().'/assets/images/categories/'.$data->image);
        }
        $data->delete();
        //--- Redirect Section
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);
        //--- Redirect Section Ends
    }
}
