<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LeadGen;
use Illuminate\Support\Facades\Log;

class LeadController extends Controller
{
    public function index()
    {
        return view('admin.lead.list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $leadgen = LeadGen::with('leadgenLocation','leadgenLocation.landmark')->where('id',$id)->first();
        return view('admin.lead.view',compact('leadgen'));
    }
}
