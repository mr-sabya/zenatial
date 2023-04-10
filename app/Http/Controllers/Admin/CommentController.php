<?php

namespace App\Http\Controllers\Admin;

use Datatables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Cookie;

class CommentController extends Controller
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
			$datas = Comment::latest()->paginate($per_page);
	        return view('admin.comment.index', compact('datas', 'per_page'));
	    }

	    //*** GET Request
	    public function show($id)
	    {
	        $data = Comment::findOrFail($id);
	        return view('admin.comment.show',compact('data'));
	    }


	    //*** GET Request Delete
		public function destroy($id)
		{
		    $comment = Comment::findOrFail($id);
		    if($comment->replies->count() > 0)
		    {
		        foreach ($comment->replies as $reply) {
		            $reply->delete();
		        }
		    }
		    $comment->delete();
		    //--- Redirect Section     
		    $msg = 'Data Deleted Successfully.';
		    return response()->json($msg);      
		    //--- Redirect Section Ends    
		}
}