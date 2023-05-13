<?php

namespace App\Http\Controllers;

use App\Models\UserEnter;
use Illuminate\Http\Request;
use Redirect, Response, File;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserEnterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserEnter::select('id', 'name', 'email', 'password')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        try {
            // $imageName = Str::random().'.'.$request->image->getClientOriginalExtension();
            // Storage::disk('public')->putFileAs('product/image', $request->image,$imageName);
            UserEnter::create($request->post());


            return response()->json([
                'message' => 'User Created Successfully!!'
            ]);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json([
                'message' => 'Something goes wrong while creating a product!!'
            ], 500);
        }
    }
    public function login(Request $request)
    {
        $name = $request->input("name");
        $email = $request->input("email");

        $user = DB::table('user_enters')->where('email', $email)->first();

        if (!Hash::check($password, $user->password)) {
            echo "Not Matched";
        } else {
            echo $user->email;
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserEnter  $userEnter
     * @return \Illuminate\Http\Response
     */
    public function show(UserEnter $userEnter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserEnter  $userEnter
     * @return \Illuminate\Http\Response
     */
    public function edit(UserEnter $userEnter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserEnter  $userEnter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserEnter $userEnter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserEnter  $userEnter
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserEnter $userEnter)
    {
        //
    }
}
