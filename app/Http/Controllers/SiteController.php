<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\CustomerController;
use App\Models\{User,Customer,CustomerSite};

class SiteController extends Controller
{
    public function sites(){
        $CustomerController = new CustomerController;
        $data['countries'] = $CustomerController->getCountry();
        if(Auth::user()->role == 'admin'){
            $data['sites'] = CustomerSite::all();
            $data['customers'] = Customer::all(['id','contact_name']);
            return view('admin.sites.all',$data);
        }else{
            $user = Auth::user();
            $data['sites'] = CustomerSite::whereHas('customer', function ($query) use ($user) {$query->where('user_id', $user->id);})->get();
            $data['customers'] = Customer::where('user_id',Auth::user()->id)->get(['id','contact_name']);
            return view('user.sites.all',$data);
        }
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'site_name' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip_code' => 'required|string',
            'country' => 'required|string'
        ]);
        $customer = CustomerSite::create([
            'customer_id' => $request->customer_id,
            'site_name' => $validatedData['site_name'],
            'street' => $validatedData['street'],
            'city' => $validatedData['city'],
            'state' => $validatedData['state'],
            'zip_code' => $validatedData['zip_code'],
            'country' => $validatedData['country']
        ]);
         return response()->json([
            'success' => true,
            'user' => $customer
        ]);
    }

    public function edit($id){
         $site = CustomerSite::find($id);
         return response()->json([
            'success' => true,
            'site' => $site
        ]);
    }

    public function delete($id){
       if(Auth::user()->role == 'user'){
        $user_id = Auth::user()->id;
            $site = CustomerSite::whereHas('customer', function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
            })->where('id', $id)->first();
        }
        else{
            $site = CustomerSite::where('id',$id)->first();
        }
        if($site->delete()){
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

    public function update(Request $request){
        $validatedData = $request->validate([
            'site_id' => 'required',
            'site_name' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip_code' => 'required|string',
            'country' => 'required|string'
        ]);
        if(Auth::user()->role == 'user'){
            $user_id = Auth::user()->id;
            $site = CustomerSite::whereHas('customer', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            })->where('id', $request->site_id)->first();
           // $site = Customer::where('user_id',Auth::user()->id)->where('id',$request->customer_id)->first();
        }else{
           $site = CustomerSite::where('id',$request->site_id)->first();
        }
        if($site){
           $site->customer_id = $request->customer_id;
           $site->site_name = $request->input('site_name');
           $site->street = $request->input('street');
           $site->city = $request->input('city');
           $site->state = $request->input('state');
           $site->zip_code = $request->input('zip_code');
           $site->country = $request->input('country');
           $site->save();
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
