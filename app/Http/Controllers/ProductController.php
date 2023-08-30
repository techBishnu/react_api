<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Validator;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::all();
        return response()->json([
            'products' => $product,

        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validatedData = Validator::make($data, [
            'name' => 'required|string|unique:products,name,',
            'description' => 'required',
            'category_id'=>'required',
            'price'=>'required|numeric',
            'quantity'=>'required|integer',
            'image'=>'required|mimes:png,jpg,jpeg|max:2056'

        ]);
        if ($validatedData->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validatedData->errors()
            ]);
        }
        try {
            $product = Product::create([
                'name'=>$data['name'],
                'description'=>$data['description'],
                'category_id'=>$data['category_id'],
                'price'=>$data['price'],
                'quantity'=>$data['quantity'],
            ]);
            if(array_key_exists('image',$data)){
                $product->addMedia($data['image'])->toMediaCollection('product_image');
            }
            return response()->json([
                'product' => $product,
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
        $Product = Product::with('media')->find($id);
        if($Product!=null){
            return response()->json([
                'product' => $Product,
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
        // dd($data);
        if(!array_key_exists('id',$data)){
            return response()->json([
                'status' => false,
                'message' =>'Something went Wrong!'
            ]);
        }

        $validatedData = Validator::make($data, [
            'name' => 'required|string|unique:products,name,'.$data['id'],
            'description' => 'required',
            'category_id'=>'required|exists:categories,id',
            'price'=>'required|numeric',
            'quantity'=>'required|integer',
            'image'=>'nullable|mimes:png,jpg,jpeg|max:2056'

        ]);
        if ($validatedData->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validatedData->errors()
            ]);
        }

        try {
            $product = Product::with('media')->find($data['id']);
            if ($product!=null) {
                $product->update([
                'name'=>$data['name'],
                'description'=>$data['description'],
                'category_id'=>$data['category_id'],
                'price'=>$data['price'],
                'quantity'=>$data['quantity'],
            ]);
            if(array_key_exists('image',$data)){
                if($product->hasMedia('product_image')){
                    $product->clearMediaCollection('product_image');
                }
                $product->addMedia($data['image'])->toMediaCollection('product_image');
            }
                return response()->json([
                    'products' => $product,
                    'status' => true,
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Product not found!'
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
            $Product = Product::find($id);
            if ($Product!=null) {
                $Product->delete();
                return response()->json([
                    'message' => 'Product deleted success',
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
