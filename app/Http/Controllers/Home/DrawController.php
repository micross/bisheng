<?php
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DrawController extends Controller
{
    public function index(Request $request)
    {
        return view('home.draw.index');
    }
}
