<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\posts;
use Carbon\Carbon;
use public\image\post;

class PostController extends Controller
{
    public function posts(){
        // $news = news::all();
         //$news = news::paginate(2);
         $posts = DB::table('posts')
         ->join('users','posts.admin','admin')
         ->select('posts.*','users.name')->paginate(5);
        //$news = DB::table('news')->paginate(1);
       // $trash = news::onlyTrashed()->paginate(2);
        return view('admin.post',compact('posts'));
    }
 
     public function store(Request $request){
        $request->validate([
            'post_name'=>'required|max:255'
        ]);
        
        //การเข้ารหัสรูปภาพ
        $img_post = $request->file('img_post');

        $name_gen = hexdec(uniqid());
        $name_ext = strtolower($img_post->getClientOriginalExtension());
        $img_name = $name_gen .'.'. $name_ext;

        $upload_location = 'image/post/';
        $full_path = $upload_location.$img_name;

        posts::insert([
            'post_name' => $request->post_name,
            'img_post' => $full_path,
            'content' => $request->content,
            'admin' => Auth::user()->id,
            'created_at' => Carbon::now()
       
        ]);
        $img_post->move($upload_location,$img_name);
        return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");
        /*
        //บันทึกข้อมูล
       
        $posts = new posts;
        $posts->news_name = $request->news_name;

        if($request->file('img_post')){
            $file = $request->file('img_post');
            $name_gen = hexdec(uniqid());
            $name_ext = strtolower($file->getClientOriginalExtension());
            $img_name = $name_gen .'.'. $name_ext;
    
            $upload_location = 'image/post';
            $full_path = $upload_location.$img_name;
            $posts->img_post = $full_path ;
        }
        
        $posts->content = $request->content ;
        $posts->admin = Auth::user()->id; 
       
        $posts->save();

        return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");
        */
    }



    public function edit($id){
        $posts = posts::find($id);
        return view('admin.postedit',compact('posts'));
    }
 
    public function update(Request $request, $id){
         $request->validate([
             'post_name'=>'required|max:255',
         ]);
         $img_post = $request->file('img_post');

         $name_gen = hexdec(uniqid());
         $name_ext = strtolower($img_post->getClientOriginalExtension());
         $img_name = $name_gen .'.'. $name_ext;
 
         $upload_location = 'image/post/';
         $full_path = $upload_location.$img_name;

     $posts = posts::find($id)->update([
        'post_name' => $request->post_name,
        'img_post' => $full_path,
        'content' => $request->content,
        'admin' => Auth::user()->id,
        'created_at' => Carbon::now()
     ]);
     $img_post->move($upload_location,$img_name);
     return redirect()->route('post')->with('success',"อัพเดทข้อมูลเรียบร้อย");
     }
 


     public function softdelete($id){
         $delete = DB::table('posts')->where('id',$id)->delete();
         return redirect()->route('post')->with('success',"ลบข้อมูลเรียบร้อย");
     }

    
}
