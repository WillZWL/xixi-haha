<?php

namespace App\Http\Controllers\Admin;

use App\Opcache;
use App\Http\Controllers\Controller;

class OpcacheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        define('THOUSAND_SEPARATOR',true);

        $dataModel = new Opcache();

        return view('admin.opcache.index', compact('dataModel'));
    }

    public function restart()
    {
        return redirect('admin.admin.index');
    }
}
