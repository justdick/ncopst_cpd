<?php

namespace App\Http\Controllers;

use App\Models\Cpd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CpdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required',
            'staff_id' => 'required|string',
            'region' => 'required|string',
            'district' => 'required|string',
            'circuit' => 'sometimes|required|string',

        ]);

        $response = Http::withHeaders([
            "Authorization" => "Bearer 1|ZGOsCt2lPRNuNdIIgf33TDfVaSseN39vshfd0KlV",
            "Content-Type" => "application/json",
            "Accept" => "application/json"

        ])->post('https://momo.ncopst.org/api/getotp', [
            'amount' => 75,
            "phone" =>  $data['phone'],
            "network" => $data['network'],
            "purpose" => 'cpd',
        ]);

        $response = json_decode($response, true);

        if($response['status'] == true){
            Cpd::create([
                'amount' => 75,
                'name' => $data['name'],
                'phone' => $data['phone'],
                'network' => $data['network'],
                'staff_id' => $data['staff_id'],
                'email' => $data['email'],
                'region' => $data['region'],
                'district' => $data['district'],
                'reference' => $response['data']['reference'],
            ]);
        }

        return view('cpd_prompt_or_otp', compact('response'));
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
        //
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

    public function callback(Request $request)
    {
        if($request->getClientIp() != ' 198.54.115.156') abort(404);

        $cpd = Cpd::where('reference', $request->reference)->first();

        if($request->status == 'charge.sucess'){
            $cpd->update([
                'paid' => 1
            ]);

        }else{
            $cpd->update([
                'status' => 0
            ]);
        }
    }
}
