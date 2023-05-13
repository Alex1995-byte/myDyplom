<?php

use App\Models\Product;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserEnterController;

use App\Models\UserEnter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::middleware(['cors'])->group(function () {
//    Route::get("/max/product", [\App\Http\Controllers\MaxController::class, 'getProduct']);
//});
//Route::get("/max/product", [\App\Http\Controllers\MaxController::class, 'getProduct']);
Route::get("/max/product", [\App\Http\Controllers\MaxController::class, 'getProduct']);
Route::get("/cat_product", [\App\Http\Controllers\ProductController::class, 'getDescription']);


Route::resource('products', ProductController::class);



Route::post('/signup', function (Request $request) {
     $request->validate([
         'name'=>'required',
         'email'=>'required|email|unique:user_enters',
         'password'=>'required'
     ]);
     $password = $request->input('password');
     $hashedPassword = Hash::make($password);

     try{
//         $imageName = Str::random().'.'.$request->image->getClientOriginalExtension();
//         Storage::disk('public')->putFileAs('product/image', $request->image,$imageName);
         UserEnter::create([
             'name' => $request->input('name'),
             'email' => $request->input('email'),
             'password' => $hashedPassword,
         ]);


         return response()->json([
             'message'=>'User Created Successfully!!'
         ]);
     }catch(\Exception $e){
         \Log::error($e->getMessage());
         return response()->json([
             'message'=>'Something goes wrong while creating a product!!'
         ],500);
     }
 });

 Route::post('/signin', function (Request $request) {
         $email = $request->input("email");
         $password = $request->input("password");

         try{
         $user = DB::table('user_enters')->where('email',$email)->first();

         if(!Hash::check($password, $user->password)){
             throw new Exception("Not Matched");
         }

         return response()->json([
             'message'=>'Login successful!'
         ]);
     }catch(\Exception $e){
         \Log::error($e->getMessage());
         return response()->json([
             'message'=>$e->getMessage()
         ],500);
     }
 });


//Route::resource('user_enters', [UserEnterController::class, 'login']);
//Route::resource('user_enters', 'UserEnterController')->except([
//    'create', 'store', 'update', 'destroy'
//]);
