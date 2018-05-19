<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Blog;
/**
 *
 */
class BlogController extends Controller
{
  public function index()
  {
    $blog = Blog::all();
    //dd($blog);
    return view ('blog/home',['blog'=>$blog]);
  }
  public function show($id)
  {
    $nilai = "ini adalah Linknya ".$id;
    //$users = DB::table('users')->pluck('username','password');
    $users = DB::table('users')
      ->select('username','alamat')
      ->join('alamat', 'users.id', '=', 'alamat.id')
      ->get();

    //dd($users);
    return view ('blog/single',['blog'=> $nilai, 'users' => $users]);
  }
}
 ?>
