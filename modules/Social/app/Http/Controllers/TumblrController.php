<?php

namespace Modules\Social\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TumblrController extends Controller
{
    public function test(Request $request)
    {
        return response()->json($request->toArray());
    }
}
