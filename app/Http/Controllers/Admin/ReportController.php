<?php

namespace App\Http\Controllers\Admin;

use Datatables;
use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Cookie;

class ReportController extends Controller
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
		$datas = Report::latest()->paginate($per_page);
		return view('admin.report.index', compact('datas', 'per_page'));
	}

	//*** GET Request
	public function show($id)
	{
		$data = Report::findOrFail($id);
		return view('admin.report.show',compact('data'));
	}


	//*** GET Request Delete
	public function destroy($id)
	{
		$data = Report::findOrFail($id);
		$data->delete();
		//--- Redirect Section     
		$msg = 'Data Deleted Successfully.';
		return response()->json($msg);      
		//--- Redirect Section Ends    
	}
}
