<?php

namespace App\Http\Controllers\Admin;
use Datatables;
use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cookie;

class FaqController extends Controller
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
        $datas = Faq::orderBy('id','desc')->get();      
        return view('admin.faq.index', compact('datas', 'per_page'));
    }

    //*** GET Request
    public function create()
    {
        $cats = FaqCategory::all();
        return view('admin.faq.create', compact('cats'));
    }

    //*** POST Request
    public function store(Request $request)
    {
        //--- Validation Section

        //--- Validation Section Ends

        //--- Logic Section
        $data = new Faq();
        $input = $request->all();
        print_r($input);
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
        $data = Faq::findOrFail($id);
        $cats = FaqCategory::all();
        return view('admin.faq.edit',compact('data', 'cats'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section

        //--- Validation Section Ends

        //--- Logic Section
        $data = Faq::findOrFail($id);
        $input = $request->all();
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
        $data = Faq::findOrFail($id);
        $data->delete();
        //--- Redirect Section     
        $msg = 'Data Deleted Successfully.';
        return redirect()->back()->with('success', $msg);     
        //--- Redirect Section Ends   
    }    
    
    //*** GET Request
    public function catIndex(Request $request)
    {
        $cookie_value = Cookie::get('entries');
        $per_page = $request->get('entries', $cookie_value);

        if (!$per_page) {
            $per_page = 10;
        }        
        Cookie::queue('entries', $per_page);  
        $datas = FaqCategory::orderBy('id','desc')->get();      
        return view('admin.faqcat.index', compact('datas', 'per_page'));
    }

    //*** GET Request
    public function catCreate()
    {
        return view('admin.faqcat.create');
    }

    //*** POST Request
    public function catStore(Request $request)
    {
        //--- Validation Section

        //--- Validation Section Ends

        //--- Logic Section
        $data = new FaqCategory();
        $input = $request->all();
        $data->fill($input)->save();
        //--- Logic Section Ends

        //--- Redirect Section        
        $msg = 'New Data Added Successfully.';
        return redirect()->back()->with('success', $msg);      
        //--- Redirect Section Ends   
    }

    //*** GET Request
    public function catEdit($id)
    {
        $data = FaqCategory::findOrFail($id);
        return view('admin.faqcat.edit',compact('data'));
    }

    //*** POST Request
    public function catUpdate(Request $request, $id)
    {
        //--- Validation Section

        //--- Validation Section Ends

        //--- Logic Section
        $data = FaqCategory::findOrFail($id);
        $input = $request->all();
        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section     
        $msg = 'Data Updated Successfully.';
        return redirect()->back()->with('success', $msg);
        //--- Redirect Section Ends              
    }

    //*** GET Request Delete
    public function catDestroy($id)
    {
        $data = FaqCategory::findOrFail($id);
        $data->delete();
        //--- Redirect Section     
        $msg = 'Data Deleted Successfully.';
        return redirect()->back()->with('success', $msg);     
        //--- Redirect Section Ends   
    }
}
