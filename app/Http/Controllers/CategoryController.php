<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return response()->json([
            'categories' => $category,

        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validatedData = Validator::make($data, [
            'name' => 'required|string|unique:categories,name,',
            'description' => 'required'

        ]);
        if ($validatedData->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validatedData->errors()
            ]);
        }
        try {
            $category = Category::create($data);
            return response()->json([
                'categories' => $category,
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'=>false,
                'message'=>$th->getMessage()
                
             ]);
        }
       
    }

    public function edit($id)
    {
        $category = Category::find($id);
        if($category!=null){
            return response()->json([
                'categories' => $category,
                'status'=>true
            ]);
        }else{
            return response()->json([
                'message' =>'Id not found!',
                'status'=>false
            ]);
        }
    }

    public function update(Request $request)
    {
        $data = $request->all();


        $validatedData = Validator::make($data, [
            'name' => 'required|string|unique:categories,name,'.$data['id'],
            'description' => 'required'

        ]);
        if ($validatedData->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validatedData->errors()
            ]);
        }

        try {
            $category = Category::find($data['id']);
            if ($category!=null) {
                $category->update($data);
                return response()->json([
                    'categories' => $category,
                    'status' => true,
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Category not found!'
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function delete($id)
    {
        try {
            $category = Category::find($id);
            if ($category!=null) {
                $categories=Product::where('category_id',$id)->get();
                if(count($categories)>0){
                    $categories->products()->delete();
                }
                $category->delete();
                return response()->json([
                    'message' => 'Category deleted success',
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'message' =>'Id not found!'
    
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()

            ]);
        }
    }
}
