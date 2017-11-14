<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;
use Purifier;
use App\Category;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
      $rules = [
        'categoryName' => 'required'
      ];

      $validator = Validator::make(Purifier::clean($request->all()), $rules);

      if($validator->fails())
      {
        return Response::json([
          'error' => 'category name required'
        ]);
      }

      $category = new Category;
      $category->name = $request->input('categoryName');
      $category->save();

      return Response::json([
        'success' => 'category added',
        'category' => $category
      ]);
    }

    public function update($id, Request $request)
    {
      $rules = [
        'categoryName' => 'required'
      ];

      $validator = Validator::make(Purifier::clean($request->all()), $rules);

      if($validator->fails())
      {
        return Response::json([
          'error' => 'category name required'
        ]);
      }

      $category = Category::find($id);
      $category->name = $request->input('categoryName');
      $category->save();

      return Response::json([
        'success' => 'category updated',
        'category' => $category
      ]);
    }

    public function delete($id)
    {
      $category = Category::find($id);
      $category->delete();

      return Response::json([
        'success' => 'category deleted'
      ]);
    }

    public function index()
    {
      $categories = Category::all();
      return Response::json([
        'categories' => $categories
      ]);
    }

    public function get($id)
    {
      $category = Category::find($id);
      return Response::json([
        'category' => $category
      ]);
    }
}
