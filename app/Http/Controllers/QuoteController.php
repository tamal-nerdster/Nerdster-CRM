<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User,Customer,CustomerSite,Quote,Product};
use Auth;

class QuoteController extends Controller
{
    public function quotes(){
        if(Auth::user()->role == 'admin'){
            $data['users'] = User::where('role','user')->get(['name','id']);
            $data['quotes'] = Quote::all();
            $data['products'] = Product::all(['name','id','base_price']);
            $data['customers'] = Customer::all(['contact_name','id','company_name']);
            return view('admin.quotes.all',$data);
        }else{
            $user = User::find(Auth::user()->id);
            $data['quotes'] = $user->quotes()->get();
            $data['products'] = Product::all(['name','id','base_price']);
            $data['customers'] = $user->customers()->get();
            $data['sites'] = CustomerSite::whereHas('customer', function ($query) use ($user) {$query->where('user_id', $user->id);})->get();
            return view('user.quotes.all',$data);
        }
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'user_id' => 'required|string|max:255',
            'customer_id' => 'required|string|max:255',
            'product_id' => 'required|string',
            'site_id' => 'required|string',
            'term_months' => 'required|string',
            // 'monthly_price' => 'required|string',
            // 'installation_fee' => 'required|string',
            'status' => 'required|string'
        ]);
        $product = Product::findOrFail($validatedData['product_id']);
        $monthlyPrice = $this->calculateMonthlyPrice($product, $validatedData['term_months']);
        $installationFee = $this->calculateInstallationFee($product, $validatedData['term_months']);
        $quote = Quote::create([
            'customer_id' => $request->customer_id,
            'user_id' => $validatedData['user_id'],
            'customer_id' => $validatedData['customer_id'],
            'product_id' => $validatedData['product_id'],
            'site_id' => $validatedData['site_id'],
            'term_months' => $validatedData['term_months'],
            'monthly_price' => $monthlyPrice,
            'installation_fee' => $installationFee,
            'status' => $validatedData['status']
        ]);
         return response()->json([
            'success' => true,
            'user' => $quote
        ]);
    }

    public function edit_quote($id){
         $site = Quote::find($id);
         return response()->json([
            'success' => true,
            'quote' => $site
        ]);
    }

    public function delete_quote($id){
       if(Auth::user()->role == 'user'){
        $user_id = Auth::user()->id;
            $site = Quote::whereHas('customer', function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
            })->where('id', $id)->first();
        }
        else{
            $site = Quote::where('id',$id)->first();
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

    public function update_quote(Request $request){
        $validatedData = $request->validate([
            'quote_id' => 'required',
            'user_id' => 'required|string|max:255',
            'customer_id' => 'required|string|max:255',
            'product_id' => 'required|string',
            'site_id' => 'required|string',
            'term_months' => 'required|string',
            // 'monthly_price' => 'required|string',
            // 'installation_fee' => 'required|string',
            'status' => 'required|string'
        ]);
        $quote = Quote::where('id',$request->quote_id)->first();
        $product = Product::findOrFail($validatedData['product_id']);
        $monthlyPrice = $this->calculateMonthlyPrice($product, $validatedData['term_months']);
        $installationFee = $this->calculateInstallationFee($product, $validatedData['term_months']);
        if($quote){
           $quote->user_id = Auth::user()->role == 'user' ? Auth::user()->id : $request->user_id;
           $quote->customer_id = $request->input('customer_id');
           $quote->product_id = $request->input('product_id');
           $quote->site_id = $request->input('site_id');
           $quote->term_months = $request->input('term_months');
           $quote->monthly_price = $monthlyPrice;
           $quote->installation_fee = $installationFee;
           $quote->status = $request->input('status');
           $quote->save();
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

    private function calculateMonthlyPrice(Product $product, int $termMonths)
    {
        // Implement pricing logic based on product and term
        $discountRate = $termMonths >= 36 ? 0.1 : 0;
        $price = $product->base_price * (1 - $discountRate);
        return round($price, 2);
    }

    private function calculateInstallationFee(Product $product, int $termMonths)
    {
        // Implement installation fee calculation logic
        $fee = $termMonths >= 36 ? 0 : 500;
        return $fee;
    }
}
