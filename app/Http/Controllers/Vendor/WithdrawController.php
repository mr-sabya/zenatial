<?php

namespace App\Http\Controllers\Vendor;

use App\Models\User;
use App\Models\Withdraw;
use App\Models\Generalsetting;
use Auth;
use App\Models\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cookie;

class WithdrawController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

  	public function index(Request $request)
    {
        $user = Auth::user();
        $cookie_value = Cookie::get('entries');
        $per_page = $request->get('entries', $cookie_value);

        if (!$per_page) {
            $per_page = 10;
        }        
        Cookie::queue('entries', $per_page);        
        $datas = Withdraw::where('user_id','=',Auth::guard('web')->user()->id)->where('type','=','vendor')->orderBy('id','desc')->latest()->paginate($per_page);
        $sign = Currency::where('is_default','=',1)->first();        
        return view('vendor.withdraw.index',compact('datas','sign', 'per_page'));
    }


    public function create()
    {
        $sign = Currency::where('is_default','=',1)->first();
        return view('vendor.withdraw.create' ,compact('sign'));
    }


    public function store(Request $request)
    {

        $from = User::findOrFail(Auth::guard('web')->user()->id);
        $curr = Currency::where('is_default','=',1)->first(); 
        $withdrawcharge = Generalsetting::findOrFail(1);
        $charge = $withdrawcharge->withdraw_fee;

        if($request->amount > 0){

            $amount = $request->amount;
            $amount = round(($amount / $curr->value),2);
            if ($from->current_balance >= $amount){
                $fee = (($withdrawcharge->withdraw_charge / 100) * $amount) + $charge;
                $finalamount = $amount - $fee;
                $finalamount = number_format((float)$finalamount,2,'.','');

                $from->current_balance = $from->current_balance - $amount;
                $from->update();

                $newwithdraw = new Withdraw();
                $newwithdraw['user_id'] = Auth::user()->id;
                $newwithdraw['method'] = $request->methods;
                $newwithdraw['bkash_no'] = $request->bkash_no;
                $newwithdraw['reference'] = $request->reference;
                $newwithdraw['amount'] = $finalamount;
                $newwithdraw['fee'] = $fee;
                $newwithdraw['type'] = 'vendor';
                $newwithdraw->save();

                return redirect()->back()->with('success', 'Withdraw Request Sent Successfully.'); 

            }else{
                 return redirect()->back()->with('success', 'Insufficient Balance.'); 
            }
        }
            return redirect()->back()->with('success', 'Please enter a valid amount.'); 

    }
}
