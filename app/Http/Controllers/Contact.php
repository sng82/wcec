<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Contact extends Controller
{
    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'phone' => 'required',
            'email' => 'required',
            'message'   => 'required|min:5',
        ]);
    }


}
