<?php

namespace App\Http\Controllers\Admin;

use Datatables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Rating;
use Cookie;

class RatingController extends Controller
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
			$datas = Rating::orderBy('id', 'desc')->paginate($per_page);	

	        return view('admin.rating.index', compact('datas', 'per_page'));
	    }

	    //*** GET Request
	    public function show($id)
	    {
	        $data = Rating::findOrFail($id);
	        return view('admin.rating.show',compact('data'));
	    }
	    //*** GET Request Delete
		public function destroy($id)
		{
		    $rating = Rating::findOrFail($id);
		    $rating->delete();
		    //--- Redirect Section     
		    $msg = 'Data Deleted Successfully.';
			return redirect()->back()->with('success', $msg);
		    //--- Redirect Section Ends    
		}
}
