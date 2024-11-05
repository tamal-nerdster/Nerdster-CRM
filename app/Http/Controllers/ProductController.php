<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Product,User,Suppliers};


class ProductController extends Controller
{
     public function products(){
        $data['suppliers'] = Suppliers::all(['name','id']);
        $data['products'] = Product::all();
        return view('admin.product.all',$data);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'bandwidth' => 'required|string|max:255',
            'base_price' => 'required|string',
            'supplier_id' => 'required'
        ]);
        $product = Product::create([
            'name' => $validatedData['name'],
            'bandwidth' => $validatedData['bandwidth'],
            'base_price' => $validatedData['base_price'],
            'supplier_id' => $validatedData['supplier_id']
        ]);
         return response()->json([
            'success' => true,
            'user' => $product
        ]);
    }

    public function edit_product($id){
         $product = Product::find($id);
         return response()->json([
            'success' => true,
            'product' => $product
        ]);
    }

    public function update_product(Request $request){
         $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'bandwidth' => 'required|string|max:255',
            'base_price' => 'required|string',
            'supplier_id' => 'required',
            'product_id' => 'required'
        ]);
        $product = Product::find($request->product_id);
        if($product){
           $product->name = $request->input('name');
           $product->bandwidth = $request->input('bandwidth');
           $product->base_price = $request->input('base_price');
           $product->supplier_id = $request->input('supplier_id');
           $product->save();
            return response()->json([
                'success' => true,
            ]);
        }else{
             return response()->json([
                'success' => false,
                'message' => 'Record not found'
            ]);
        }
    }

    public function delete_product($id){
        $product = Product::find($id);
        if($product->delete()){
            return response()->json([
                'success' => true,
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Record not found'
            ]);
        }
    }
}
