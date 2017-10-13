<?php

namespace App\Http\Controllers;

/**
 * Class AboutController
 * @package App\Http\Controllers
 */
class AboutController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('about.index');
    }
}