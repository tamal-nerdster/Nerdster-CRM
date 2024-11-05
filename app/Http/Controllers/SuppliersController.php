<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Suppliers,User};

class SuppliersController extends Controller
{
    public function supplier(){
        $data['suppliers'] = Suppliers::all();
        return view('admin.supplier.all',$data);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'api_endpoint' => 'required|string|max:255',
            'api_key' => 'required|string'
        ]);
        $customer = Suppliers::create([
            'name' => $validatedData['name'],
            'api_endpoint' => $validatedData['api_endpoint'],
            'api_key' => $validatedData['api_key']
        ]);
         return response()->json([
            'success' => true,
            'user' => $customer
        ]);
    }

    public function edit_supplier($id){
         $supplier = Suppliers::find($id);
         return response()->json([
            'success' => true,
            'supplier' => $supplier
        ]);
    }

    public function update_supplier(Request $request){
        $validatedData = $request->validate([
            'supplier_id' => 'required',
            'name' => 'required|string|max:255',
            'api_endpoint' => 'required|string|max:255',
            'api_key' => 'required|string'
        ]);
        $supplier = Suppliers::find($request->supplier_id);
        if($supplier){
           $supplier->name = $request->input('name');
           $supplier->api_endpoint = $request->input('api_endpoint');
           $supplier->api_key = $request->input('api_key');
           $supplier->save();
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

    public function delete_supplier($id){
        $supplier = Suppliers::find($id);
        if($supplier->delete()){
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
