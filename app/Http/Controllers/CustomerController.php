<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\{Customer,User};
use Illuminate\Support\Facades\File;
use Auth;

class CustomerController extends Controller
{
    public function getCountry(){
         $contents = File::get('dataset/countries.json');
         $countries = json_decode($contents,TRUE);
         return $countries;
    }


    public function customers(){
        $data['countries'] = $this->getCountry();
        if(Auth::user()->role == 'admin'){
            $data['customers'] = Customer::all();
            $data['users'] = User::where('role','user')->get(['id','name']);
            return view('admin.customers.all',$data);
        }else{
            $data['customers'] = Customer::where('user_id',Auth::user()->id)->get();
            return view('user.customers.all',$data);
        }
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|min:8',
            'street' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip_code' => 'required',
            'country' => 'required',
        ]);
        $customer = Customer::create([
            'user_id' => Auth::user()->role == 'user' ? Auth::user()->id : $request->user_id,
            'company_name' => $validatedData['company_name'],
            'contact_name' => $validatedData['contact_name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'street' => $validatedData['street'],
            'city' => $validatedData['city'],
            'state' => $validatedData['state'],
            'zip_code' => $validatedData['zip_code'],
            'country' => $validatedData['country'],
        ]);
         return response()->json([
            'success' => true,
            'user' => $customer
        ]);
    }

    public function delete($id){
        if(Auth::user()->role == 'user'){
            $user = Customer::where('user_id',Auth::user()->id)->where('id',$id)->first();
        }else{
            $user = Customer::where('id',$id)->first();
        }
        if($user->delete()){
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

    public function edit($id){
         $user = Customer::find($id);
         return response()->json([
            'success' => true,
            'user' => $user
        ]);
    }

    public function update(Request $request){
        $validatedData = $request->validate([
            'customer_id' => 'required',
            'company_name' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|min:8',
            'street' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip_code' => 'required',
            'country' => 'required',
        ]);
        if(Auth::user()->role == 'user'){
            $customer = Customer::where('user_id',Auth::user()->id)->where('id',$request->customer_id)->first();
        }else{
            $customer = Customer::where('id',$request->customer_id)->first();
        }
        if($customer){
            $customer->user_id = Auth::user()->role == 'user' ? Auth::user()->id : $request->user_id;
            $customer->company_name = $request->input('company_name');
            $customer->contact_name = $request->input('contact_name');
            $customer->email = $request->input('email');
            $customer->phone = $request->input('phone');
            $customer->street = $request->input('street');
            $customer->city = $request->input('city');
            $customer->state = $request->input('state');
            $customer->zip_code = $request->input('zip_code');
            $customer->country = $request->input('country');
            $customer->save();
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
