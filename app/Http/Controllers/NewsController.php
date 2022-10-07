<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\News;
use Carbon\Carbon;

class NewsController extends Controller
{
    public function news(){
       // $news = news::all();
        //$news = news::paginate(2);
        $news = DB::table('news')
        ->join('users','news.admin','admin')
        ->select('news.*','users.name')->paginate(2);
       //$news = DB::table('news')->paginate(1);
      // $trash = news::onlyTrashed()->paginate(2);
       return view('admin.news',compact('news'));
   }

    public function store(Request $request){
       $request->validate([
           'news_name'=>'required|max:255',
       ]);

   //การเข้ารหัสรูปภาพ
   $img_post = $request->file('file_news');

   $name_gen = hexdec(uniqid());
   $name_ext = strtolower($img_post->getClientOriginalExtension());
   $img_name = $name_gen .'.'. $name_ext;

   $upload_location = 'file/news/';
   $full_path = $upload_location.$img_name;

       //บันทึกข้อมูล
       news::insert([
        'news_name' => $request->news_name,
        'type' => $request->type,
        'description' => $request->description,
        'content' => $request->content,
        'file_news' => $full_path,
        'admin' => Auth::user()->id,
        'created_at' => Carbon::now()
   
    ]);
    $img_post->move($upload_location,$img_name);
    return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");
   /*    
       $news = new news;
       $news->news_name = $request->news_name;
       $news->type = $request->type ;
       $news->description = $request->description ;
       $news->content = $request->content ;
       $news->admin = Auth::user()->id; 
      
       $news->save();

       $data["user_id] = Auth::user()->id;
       
      $data = array();
      $data['news_name'] = $request->news_name;
      $data['type'] = $request->type;
      $data['description'] = $request->description;
      $data['content'] = $request->content;
      $data['admin'] = Auth::user()->id;

      DB::table('news')->insert($data);
        */
       return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");
   }
   public function edit($id){
       $news = news::find($id);
       return view('admin.newsedit',compact('news'));
   }

   public function update(Request $request, $id){
        $request->validate([
            'news_name'=>'required|max:255',
        ]);
        $img_post = $request->file('img_post');

         $name_gen = hexdec(uniqid());
         $name_ext = strtolower($img_post->getClientOriginalExtension());
         $img_name = $name_gen .'.'. $name_ext;
 
         $upload_location = 'image/post/';
         $full_path = $upload_location.$img_name;


    $news = news::find($id)->update([
        'news_name' => $request->news_name,
        'type' => $request->type ,
        'description' => $request->description ,
        'content' => $request->content ,
        'file_news' => $full_path,
        'admin' => Auth::user()->id,
        'created_at' => Carbon::now()
    ]);
    return redirect()->route('news')->with('success',"อัพเดทข้อมูลเรียบร้อย");
    }

    public function softdelete($id){
        $delete = DB::table('news')->where('id',$id)->delete();
        return redirect()->route('news')->with('success',"ลบข้อมูลเรียบร้อย");
    }
}