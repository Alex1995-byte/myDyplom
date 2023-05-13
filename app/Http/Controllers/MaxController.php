<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class MaxController extends Controller
{
    public function getProduct(Request $request)
    {
        $data = Category::all('id','title');
        return response()->json($data);
    }


}
