<?php

namespace App\Http\Controllers;

use App\Models\atricle;
use App\Models\like;
use App\Models\User;
use App\Models\view;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class customControler extends Controller
{
  public function index()
    {
        return view('login');
    }  
      
    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('Signed in');
        }
  
        return redirect("login")->withSuccess('Login details are not valid');
    }

    public function registration()
    {
        return view('registration');
    }
      
    public function customRegistration(Request $request)
    {  
       
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("dashboard")->withSuccess('You have signed-in');
    }

    public function create(array $data)
    {
      return User::create([
        'first_name' => $data['fname'],
        'last_name' => $data['lname'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }    
    
    public function dashboard()
    {
        $user = Auth::user();
        $posts = atricle::all();
        /* $likes = like::where('user_id',$user->id)->get('article_id');
        $like_array=[];
        foreach($likes as $like){
            array_push($like_array,$like->article_id);
        } */

        if(Auth::check()){
            return view('home',['user'=>$user,'posts'=>$posts]);
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
    public function create_post(Request $request) {
  
        $user =  Auth::user();
        return view('createpost',['user'=>$user]);
    }
    public function save_post(Request $request) {
        atricle::create([
            'user_id' => $request->user,
            'title' => $request->title,
            'description' => $request->desc,
        ]);
        return redirect()->back();
    }
    public function show_post(Request $request) {
        $user =  Auth::user();
        $posts= atricle::where('user_id',Auth::user()->id)->get();
        
        return view('posts',['posts'=>$posts,'user'=>$user]);
    }
    public function delete_post(Request $request,$id) {
        DB::table('atricles')->where('id', '=', $id)->delete();
        return redirect('posts');
        
        // return view('posts',['posts'=>$posts,'user'=>$user]);
    }
    public function edit_post(Request $request,$id) {
        $user =  Auth::user();
        $post = atricle::findorFail($id);
        return view('edit',['post'=>$post,'user'=>$user]);
    }
    public function update_post(Request $request) {
        
        DB::table('atricles')
                ->where('id', $request->post)
                ->update(['title'=>$request->title,
                'description'=>$request->desc,
                ]);
            return redirect('posts');
        /* $post = atricle::findorFail($id);
        return view('edit',['post'=>$post,'user'=>$user]); */
    }
    public function like_post(Request $request) {
        // $liked_by = [];
        // array_push($liked_by,Auth::user()->id);
        $article= DB::table('atricles')
        ->where('id', $request->id)
        ->get();
        $total_likes = ++$article[0]->likes;
        DB::table('atricles')
                ->where('id', $request->id)
                ->update([
                    'likes'=>$total_likes,
                ]);
        like::create([
            'user_id' => Auth::user()->id,
            'article_id' => $request->id,
        ]);
        
        return response()->json([
            'status' => '200',
            'total_like'=>$total_likes,
        ]);
    }
    public function unlike_post(Request $request) {
        $article= DB::table('atricles')
        ->where('id', $request->id)
        ->get('unlikes');
        $total_unlikes = ++$article[0]->unlikes;
        DB::table('atricles')
                ->where('id', $request->id)
                ->update(['unlikes'=>$total_unlikes,
                ]);
        return response()->json([
            'status' => '200',
            'total_like'=>$total_unlikes,
        ]);
    }
    public function view_post($id) {
        
        $article = atricle::find($id);
        $user = Auth::user();
        $views= ++$article->views;
        $likes = like::where('user_id',$user->id)
        ->where('article_id',$id)
        ->get('article_id');
        $like_array=[];
        foreach($likes as $like){
            array_push($like_array,$like->article_id);
        }
        DB::table('atricles')
                ->where('id', $id)
                ->update(['views'=>$views,
                ]);
        return view('user',['posts'=>$article,'user'=>$user,'likes'=>$like_array]);
    }
}
