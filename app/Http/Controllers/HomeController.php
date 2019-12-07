<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function ListAll(Request $request)
    {

        exec("Rscript " . resource_path() . "\\R\\Test.R  $level1 $level2", $response);

        $data = json_decode($response[0]);

        return view($this->localview . '.List', compact('level3', 'level1', 'level2'))
            ->with('data', $data);
    }

}
