<?php

namespace App\Http\Controllers;


use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class AuthController extends Controller
{


     public static function Signup(Request $request){



         $validator= Validator::make($request->all(), [
             'name' => 'required|string|max:255',
             'email' => 'required|string|email|max:255|unique:users',
             'password' => 'required|string|min:6',
             'roleName' => 'required|string',
             'roleColor' => 'required|string',
         ]);

         if ($validator->fails()) {

             return response()->json($validator->errors(),409);
         }
         else {
            $user= new User([
                 'id'=>Str::uuid(),
                 'name' => $request->name,
                 'email' => $request->email,
                 'password' =>Hash::make($request->password),
                 'roleName' => $request->roleName,
                 'roleColor' => $request->roleColor,


             ]);
            $user->save();
             return response()->json(["success" =>true],201);
         }
         }

         public static function Signin(Request $request)
         {
             $validator= Validator::make($request->all(), [
                 'email' => 'required',
                 'password' => 'required|string|min:6',
             ]);

             if ($validator->fails()) {

                 return response()->json('',404);
             }
             else {
//                 check email
            $user=User::where('email',$request['email'])->first();
            //check password
            if(!$user || !Hash::check($request['password'],$user->password)){
                return response()->json(['message'=>'enter valid credintals'],404);
            }

                     return response()->json(['uuid'=>$user->id]);



             }
         }

         public static function show(Request $request)
         {
             $validator= Validator::make($request->all(), [
                 'uuid' => 'required|uuid',

             ]);

             if ($validator->fails()) {

                 return response()->json('',404);
             }
             else {
                 $user=User::find($request['uuid']);
                 if($user)
                 {
                     return response()->json([
                         'displayName'=>$user->name,
                         'roleName'=>$user->roleName,
                         'roleColor'=>$user->roleColor,
                         'group'=>2
                     ]);
                 }

             }

         }

}

