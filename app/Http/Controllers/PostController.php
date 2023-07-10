<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Breakfast;
use Validator;



class PostController extends Controller
{
    //

    public function index()
    { $image=Breakfast::where('image','test.png')->get();
        $path='public/image/'.$image;

        return view('form')->with('path',$path);
    }

 
  
    


}
