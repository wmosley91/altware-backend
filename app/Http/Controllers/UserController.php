<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;
use Purifier;
use Hash;
use JWTAuth;
use App\User;

class UserController extends Controller
{
    public function signUp(Request $request)
    {
      $rules = [
        'name' => 'required',
        'email' => 'required',
        'password' => 'required'
      ];

      $validator = Validator::make(Purifier::clean($request->all()), $rules);

      if($validator->fails())
      {
        return Response::json([
          'error' => 'fill out all fields'
        ]);
      }

      $user = new User;
      $user->roleID = 1;
      $user->name = $request->input('name');
      $user->email = $request->input('email');
      $user->password = Hash::make($request->input('password'));
      $user->save();

      return Response::json([
        'success' => 'user created',
        'user' => $user
      ]);
    }

    public function signIn(Request $request)
    {
      $rules = [
        'email' => 'required',
        'password' => 'required'
      ];

      $validator = Validator::make(Purifier::clean($request->all()), $rules);

      if($validator->fails())
      {
        return Response::json([
          'error' => 'invalid credentials'
        ]);
      }

      $email = $request->input('email');
      $password = $request->input('password');
      $credentials = compact('email', 'password');
      $token = JWTAuth::attempt($credentials);

      if($token == false)
      {
        return Response::json([
          'error' => 'something went wrong'
        ]);
      }
      else
      {
        return Response::json([
          'success' => 'signed in',
          'token' => $token
        ]);
      }
    }
}
