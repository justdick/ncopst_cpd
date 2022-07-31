<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Cpd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class CpdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $cpds = Cpd::where([
                ['new_cpd', '=', 1],
            ])->orderBy('id', 'desc')
            ->get();

            return Datatables::of($cpds)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                        $actionBtn = '<button class="btn btn-success btn-sm attended">Paid</button>';
                        return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }else{
            return view('cpd_index');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cpd_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cpd  $cpd
     * @return \Illuminate\Http\Response
     */
    public function show(Cpd $cpd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cpd  $cpd
     * @return \Illuminate\Http\Response
     */
    public function edit(Cpd $cpd)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cpd  $cpd
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cpd $cpd)
    {
        $cpd->attended = 1;
        $cpd->save();
        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cpd  $cpd
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cpd $cpd)
    {
        //
    }


    public function checkAdmin(Request $request)
    {
        if ($request->ajax()) {
            $cpds = Cpd::where([['new_cpd', '=', 1]])->get();

            return Datatables::of($cpds)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    if($row->attended == 0){
                        $actionBtn = '<button data-remote="'. route('cpd.update', $row->id) . '" class="btn btn-success btn-sm attended">Mark Attended</button>';
                        return $actionBtn;
                    }

                    $actionBtn = '<button class="btn btn-success btn-sm attended">Attended</button>';
                    return $actionBtn;

                })
                ->rawColumns(['action'])
                ->make(true);
        }else{
            return view('markAttendance');
        }
    }
}
