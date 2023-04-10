<?php

namespace App\Http\Controllers\Admin;
use App\Models\Generalsetting;
use Artisan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Currency;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;

class GeneralSettingController extends Controller
{

    protected $rules =
    [
        'logo'              => 'mimes:jpeg,jpg,png,svg',
        'favicon'           => 'mimes:jpeg,jpg,png,svg,ico',
        'loader'            => 'mimes:gif',
        'admin_loader'      => 'mimes:gif',
        'affilate_banner'   => 'mimes:jpeg,jpg,png,svg',
        'error_banner'      => 'mimes:jpeg,jpg,png,svg',
        'popup_background'  => 'mimes:jpeg,jpg,png,svg',
        'invoice_logo'      => 'mimes:jpeg,jpg,png,svg',
        'user_image'        => 'mimes:jpeg,jpg,png,svg',
        'footer_logo'        => 'mimes:jpeg,jpg,png,svg',
    ];

    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    private function setEnv($key, $value,$prev)
    {
        file_put_contents(app()->environmentFilePath(), str_replace(
            $key . '=' . $prev,
            $key . '=' . $value,
            file_get_contents(app()->environmentFilePath())
        ));
    }

    // Genereal Settings All post requests will be done in this method
    public function generalupdate(Request $request)
    {
        //--- Validation Section
        $validator = Validator::make(Input::all(), $this->rules);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Invalid file types.');
        }
        //--- Validation Section Ends

        //--- Logic Section
        else {

        $input = $request->all();

        $data = Generalsetting::findOrFail(1);
            if ($file = $request->file('logo'))
            {
                $name = time().$file->getClientOriginalName();
                $data->upload($name,$file,$data->logo);
                $input['logo'] = $name;
            }
            if ($file = $request->file('favicon'))
            {
                $name = time().$file->getClientOriginalName();
                $data->upload($name,$file,$data->favicon);
                $input['favicon'] = $name;
            }
            if ($file = $request->file('loader'))
            {
                $name = time().$file->getClientOriginalName();
                $data->upload($name,$file,$data->loader);
                $input['loader'] = $name;
            }
            if ($file = $request->file('admin_loader'))
            {
                $name = time().$file->getClientOriginalName();
                $data->upload($name,$file,$data->admin_loader);
                $input['admin_loader'] = $name;
            }
            if ($file = $request->file('popup_background'))
            {
                $name = time().$file->getClientOriginalName();
                $data->upload($name,$file,$data->popup_background);
                $input['popup_background'] = $name;
            }
            if ($file = $request->file('invoice_logo'))
            {
                $name = time().$file->getClientOriginalName();
                $data->upload($name,$file,$data->invoice_logo);
                $input['invoice_logo'] = $name;
            }
            if ($file = $request->file('user_image'))
            {
                $name = time().$file->getClientOriginalName();
                $data->upload($name,$file,$data->user_image);
                $input['user_image'] = $name;
            }

            if ($file = $request->file('footer_logo'))
            {
                $name = time().$file->getClientOriginalName();
                $data->upload($name,$file,$data->footer_logo);
                $input['footer_logo'] = $name;
            }
        $data->update($input);
        //--- Logic Section Ends

        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');

        //--- Redirect Section
        $msg = 'Data Updated Successfully.';
        return redirect()->back()->with('success', $msg);
        //--- Redirect Section Ends
        }
    }

    public function generalupdatepayment(Request $request)
    {
        //--- Validation Section
        $validator = Validator::make(Input::all(), $this->rules);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        else {
        $input = $request->all();
        $curr = Currency::where('is_default','=',1)->first();
        $data = Generalsetting::findOrFail(1);
        $prev = $data->molly_key;  
        
        if ($request->vendor_ship_info == ""){
            $input['vendor_ship_info'] = 0;
        }

        if ($request->instamojo_sandbox == ""){
            $input['instamojo_sandbox'] = 0;
        }

        if ($request->paypal_mode == ""){
            $input['paypal_mode'] = 'live';
        }
        else {
            $input['paypal_mode'] = 'sandbox';
        }

        if ($request->paytm_mode == ""){
            $input['paytm_mode'] = 'live';
        }
        else {
            $input['paytm_mode'] = 'sandbox';
        }
        $input['fixed_commission'] = $input['fixed_commission'] / $curr->value;
        $data->update($input);


        $this->setEnv('MOLLIE_KEY',$data->molly_key,$prev);
        // Set Molly ENV

        //--- Logic Section Ends

        //--- Redirect Section
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);
        //--- Redirect Section Ends
        }
    }

    public function logo()
    {
        return view('admin.generalsetting.logo');
    }

    public function userimage()
    {
        return view('admin.generalsetting.user_image');
    }

    public function fav()
    {
        return view('admin.generalsetting.favicon');
    }

     public function load()
    {
        return view('admin.generalsetting.loader');
    }

     public function contents()
    {
        return view('admin.generalsetting.sitewidecontent');
    }

     public function topHeader()
    {
        return view('admin.generalsetting.topheader');
    }

     public function footer()
    {
        return view('admin.generalsetting.footer');
    }

     public function seo()
    {
        return view('admin.generalsetting.seo');
    }
     public function social()
    {
        return view('admin.generalsetting.social');
    }

    public function paymentsinfo()
    {
        $curr = Currency::where('is_default','=',1)->first();
        return view('admin.generalsetting.paymentsinfo',compact('curr'));
    }


    public function errorbanner()
    {
        return view('admin.generalsetting.error_banner');
    }

    public function popup()
    {
        return view('admin.generalsetting.popup');
    }
    
    public function ispopup($status)
    {

        $data = Generalsetting::findOrFail(1);
        $data->is_popup = $status;
        $data->update();
    }


    public function mship($status)
    {

        $data = Generalsetting::findOrFail(1);
        $data->multiple_shipping = $status;
        $data->update();
    }


    public function mpackage($status)
    {

        $data = Generalsetting::findOrFail(1);
        $data->multiple_packaging = $status;
        $data->update();
    }

    public function guest($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->guest_checkout = $status;
        $data->update();
    }

    public function isemailverify($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_verification_email = $status;
        $data->update();
    }


    public function cod($status)
    {

        $data = Generalsetting::findOrFail(1);
        $data->cod_check = $status;
        $data->update();
    }

    public function comment($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_comment = $status;
        $data->update();
    }

    public function issmtp($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_smtp = $status;
        $data->update();
    }

    public function talkto($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_talkto = $status;
        $data->update();
    }

    public function issubscribe($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_subscribe = $status;
        $data->update();
    }

    public function isloader($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_loader = $status;
        $data->update();
    }

    public function stock($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->show_stock = $status;
        $data->update();
    }

    public function ishome($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_home = $status;
        $data->update();
    }

    public function isadminloader($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_admin_loader = $status;
        $data->update();
    }

    public function isdisqus($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_disqus = $status;
        $data->update();
    }

    public function iscontact($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_contact = $status;
        $data->update();
    }
    public function isfaq($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_faq = $status;
        $data->update();
    }
    public function currency($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_currency = $status;
        $data->update();
    }
    public function regvendor($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->reg_vendor = $status;
        $data->update();
    }

    public function isreport($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_report = $status;
        $data->update();
    }

}
