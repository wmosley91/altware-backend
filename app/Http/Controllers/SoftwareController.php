<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;
use Purifier;
use App\Software;

class SoftwareController extends Controller
{
    public function __construct()
    {
      $this->middleware('jwt.auth', ['only' => ['store', 'update', 'delete']]);
    }

    public function store(Request $request)
    {
      $rules = [
        'categoryID' => 'required',
        'topicTitle' => 'required',
        'brandName' => 'required',
        'brandImg' => 'required',
        'brandLink' => 'required',
        'altName' => 'required',
        'altImg' => 'required',
        'altLink' => 'required',
        'brandReason' => 'required',
        'altReason' => 'required'
      ];

      $validator = Validator::make(Purifier::clean($request->all()), $rules);

      if($validator->fails())
      {
        return Response::json([
          'error' => 'please fill out all fields'
        ]);
      }

      $brandImg = $request->file('brandImg');
      $brandImgName = $brandImg->getClientOriginalName();
      $brandImg->move('storage/', $brandImgName);

      $altImg = $request->file('altImg');
      $altImgName = $altImg->getClientOriginalName();
      $altImg->move('storage/', $altImgName);

      $software = new Software;
      $software->categoryID = $request->input('categoryID');
      $software->topicTitle = $request->input('topicTitle');
      $software->brandName = $request->input('brandName');
      $software->brandImg = $request->root() . 'storage/' . $brandImgName;
      $software->brandLink = $request->input('brandLink');
      $software->altName = $request->input('altName');
      $software->altImg = $request->root() . 'storage/' . $altImgName;
      $software->altLink = $request->input('altLink');
      $software->brandReason = $request->input('brandReason');
      $software->altReason = $request->input('altReason');
      $software->save();

      return Response::json([
        'success' => 'software added',
        'software' => $software
      ]);
    }

    public function update($id, Request $request)
    {
      $software = Software::find($id);

      $categoryID = $request->input('categoryID');
      $topicTitle = $request->input('topicTitle');
      $brandName = $request->input('brandName');
      $brandImg = $request->file('brandImg');
      $brandLink = $request->input('brandLink');
      $altName = $request->input('altName');
      $altImg = $request->file('altImg');
      $altLink = $request->input('altLink');
      $brandReason = $request->input('brandReason');
      $altReason = $request->input('altReason');

      if($categoryID != NULL)
      {
        $software->categoryID = $categoryID;
      }
      if($topicTitle != NULL)
      {
        $software->topicTitle = $topicTitle;
      }
      if($brandName != NULL)
      {
        $software->brandName = $brandName;
      }
      if($brandImg != NULL)
      {
        $brandImgName = $brandImg->getClientOriginalName();
        $brandImg->move('storage/', $brandImgName);
        $software->brandImg = $request->root() . 'storage/' . $brandImgName;
      }
      if($brandLink != NULL)
      {
        $software->brandLink = $brandLink;
      }
      if($altName != NULL)
      {
        $software->altName = $altName;
      }
      if($altImg != NULL)
      {
        $altImgName = $altImg->getClientOriginalName();
        $altImg->move('storage/', $altImgName);
        $software->altImg = $request->root() . 'storage/' . $altImgName;
      }
      if($altLink != NULL)
      {
        $software->altLink = $altLink;
      }
      if($brandReason != NULL)
      {
        $software->brandReason = $brandReason;
      }
      if($altReason != NULL)
      {
        $software->altReason = $altReason;
      }

      $software->save();

      return Response::json([
        'success' => 'software updated',
        'software' => $software
      ]);
    }

    public function delete($id)
    {
      $software = Software::find($id);
      $software->delete();

      return Response::json([
        'success' => 'software deleted'
      ]);
    }

    public function index()
    {
      $softwares = Software::all();
      return Response::json([
        'softwares' => $softwares
      ]);
    }

    public function get($id)
    {
      $software = Software::find($id);
      return Response::json([
        'software' => $software
      ]);
    }
}
