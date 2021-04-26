<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function uploadAvatar(Request $request)
    {
        if($request->hasFile("image")){
            User::uploadAvatar($request->image);
            return redirect()->back()->with("message", "image uploaded.");// success message
         }
         
         
         return redirect()->back()->with("error", "image not uploaded.");// error message 
    }

   

    public function index()
    {
        $data = [
            "name" => "Henry",
            "email" => "Henry@gmail.com",
            "password" => "password",
        ];
        //User::create($data);
        //$user = new User();
        //$user-> name = "lehis";
        //$user-> email = "lehis@gmail.com";
        //$user-> password = bcrypt("password");
        //$user->save();

        //User::where("id", 2) -> delete();

        //User::where("id", 2)->update(["name"=>"New Lehis2"]);
        $user = User::all();
        return $user;



        // DB::insert("insert into users (name,email,password) values (?,?,?)", [
        //     "lehis", "lehis@gmail.com","password",
        // ]);

        //$users = DB::select("select * from users");
        //return $users;

        //DB::update("update users set name = ? where id = 1", ["lehis"]);

        //DB::delete("delete  from users where id = 1");



        //$users = DB::select("select * from users");
        //return $users;


        return view("home");
    } 
}