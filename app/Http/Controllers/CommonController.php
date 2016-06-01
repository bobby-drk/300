<?php

namespace App\Http\Controllers;



class CommonController extends Controller
{
    /**
     * shows the initial page for the pay section of the site
     * @return view
     */
    public function index()
    {
        $data = [];
        return view('pages.home', $data);
    }
}
