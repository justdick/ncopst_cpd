<?php

namespace App\Http\Controllers;

use App\Models\Pageant;
use App\Models\Payment;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PageantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageants = Pageant::all();

        return view('pageant_index' ,compact('pageants'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()) return redirect('/login');
        return view('pageant_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'firstname' => 'required|string',
        //     'lastname' => 'required|string',
        //     'contact' => 'required|string',
        //     'dateofbirth' => 'required|string',
        //     'gender' => 'required|string',
        //     'schoolname' => 'required|string',
        //     'image' => 'required|file|mimes:jpg,png',
        //     'inspiration' => 'required|string',
        // ]);

        $newImageName = time() . '-' . $request->image->getClientOriginalName();
        $request->image->move(public_path('pageant_images'), $newImageName);

        $post = Pageant::create([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'contact' => $request->input('contact'),
            'dateofbirth' => $request->input('dateofbirth'),
            'gender' => $request->input('gender'),
            'schoolname' => $request->input('schoolname'),
            'image' => $newImageName,
            'inspiration' => $request->input('body')
        ]);

        return back()->with('success', 'Pageant Created Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pageant  $pageant
     * @return \Illuminate\Http\Response
     */
    public function show(Pageant $pageant)
    {
        session(['pageant_image' => $pageant->image]);
        return view('pageant_show', compact('pageant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pageant  $pageant
     * @return \Illuminate\Http\Response
     */
    public function edit(Pageant $pageant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pageant  $pageant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pageant $pageant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pageant  $pageant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pageant $pageant)
    {
        //
    }


}
