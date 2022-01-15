<?php

namespace App\Http\Controllers;

use App\Models\Cpd;
use App\Models\Vote;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

     /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        return $payment->status;
    }


    public function pay (Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required',
            'network' => 'required|string',
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
            "purpose" => 'cpdtest',
        ]);

        $response = json_decode($response, true);
// dd($response['data']);

        if($response['status'] == true){
            Payment::create([
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

        return view('prompt_or_otp', compact('response'));
    }

    public function send_otp(Request $request)
    {
        $data = $request->validate([
            'otp' => 'required|string',
            'reference' => 'required|string',
        ]);

        $response = Http::withHeaders([
            "Authorization" => "Bearer 1|ZGOsCt2lPRNuNdIIgf33TDfVaSseN39vshfd0KlV",
            "Content-Type" => "application/json",
            "Accept" => "application/json"

        ])->post('https://momo.ncopst.org/api/sendotp', [
            'otp' => $data['otp'],
            'reference' => $data['reference'],
        ]);

        $response = json_decode($response, true);
        return view('prompt_or_otp', compact('response'));
    }

    public function callback(Request $request)
    {
        if($request->getClientIp() != ' 198.54.115.156') abort(404);

        $payment = Payment::where('reference', $request->reference)->first();

        if($request->status == 'charge.sucess'){
            $payment->update([
                'status' => 'Sucessfull'
            ]);

            Cpd::create($payment);
        }else{
            $payment->update([
                'status' => $request->status
            ]);
        }
    }
}
