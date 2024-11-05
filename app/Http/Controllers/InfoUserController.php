<?php

namespace App\Http\Controllers;

use App\Models\{User,CustomerSite};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

class InfoUserController extends Controller
{

    public function create()
    {
        return view('laravel-examples/user-profile');
    }

    public function store(Request $request)
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
            'phone'     => ['max:50']
        ]);   

        User::where('id',Auth::user()->id)
        ->update([
            'name'    => $attributes['name'],
            'email' => $attributes['email'],
            'phone'     => $attributes['phone'],
        ]);


        return redirect('/user-profile')->with('success','Profile updated successfully');
    }

    public function change_password(Request $request){
        $user = User::where('id', Auth::user()->id)->first();
        if(!$user){
            return back()->with('error','Unauthorized access');
        }
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->password = Hash::make($request->password);
        $user->save();
        return back()->with('success','Password successfully chnaged');
    }

    public function store_user(Request $request){
         $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'required|string|min:8|',
            'role' => 'required|in:user,admin',
        ]);
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'password' => Hash::make($validatedData['password']),
            'role' => $validatedData['role'],
        ]);
        if ($request->has('send_welcome_email')) {
            // Send welcome email
            $plainPassword = $request->input('password');
            Mail::to($user->email)->send(new WelcomeMail($user, $plainPassword));
        }
        // Return success response
        return response()->json([
            'success' => true,
            'user' => $user
        ]);

    }

    public function edit_user($id){
        $user = User::find($id);
         return response()->json([
            'success' => true,
            'user' => $user
        ]);
    }

    public function update_user(Request $request){
        $user = User::find($request->user_id);
         $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|unique:users,phone,' . $user->id,
            'role' => 'required|in:user,admin',
        ]);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->role = $request->input('role');
        $user->save();
        return response()->json([
            'success' => true,
            'user' => $user
        ]);
    }

    public function delete_user($id){
        $user = User::find($id);
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
        //return $user;
    }

    public function user_details($id){
        $user = User::find($id);
        $cus = $user->customers()->get();
        $sites = CustomerSite::whereHas('customer', function ($query) use ($user) {$query->where('user_id', $user->id);})->get();
        return response()->json([
            'success' => true,
            'users' => $user,
            'customers' => $cus,
            'sites' => $sites
        ]);
    }
}
