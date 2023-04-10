<?php

namespace App\Http\Controllers\Admin;
use Datatables;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cookie;
use Auth;

class SubscriberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
         $datas = Subscriber::orderBy('id')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->addColumn('sl', function(Subscriber $data) {
                                $id = 1;
                                return $id++;
                            }) 
                            ->toJson();//--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index(Request $request)
    {
        $user = Auth::user();
        $cookie_value = Cookie::get('entries');
        $per_page = $request->get('entries', $cookie_value);

        if (!$per_page) {
            $per_page = 10;
        }        
        Cookie::queue('entries', $per_page);        
        $datas = Subscriber::orderBy('id')->latest()->paginate($per_page);
        return view('admin.subscribers.index', compact('datas', 'per_page'));
    }
    //*** GET Request
    public function download()
    {
        //  Code for generating csv file
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=subscribers.csv');
        $output = fopen('php://output', 'w');
        fputcsv($output, array('Subscribers Emails'));
        $result = Subscriber::all();
        foreach ($result as $row){
            fputcsv($output, $row->toArray());
        }
        fclose($output);
    }
}
