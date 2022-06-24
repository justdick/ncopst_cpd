<?php

namespace App\Http\Controllers;

use App\Models\Cpd;
use App\Models\Vote;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use PDF;

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
    public function show(Request $request)
    {
        $payment = Payment::select('name', 'amount', 'email')->where('reference', $request->reference)->first();

        if($payment->status == 'Successfull'){
            $data = [
                'title' => "Receipt",
                'date' => date('dd/mm/yyyy h:i:s'),
                'name' => $payment->name,
                'amount' => $payment->amount,
                'email' => $payment->email,
            ];

            $pdf = PDF::loadView('receipt', $data);


            $pdf->download('receipt.pdf');
        }



        return $payment->status;
    }


    public function pay (Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'bail|required|string|unique:cpds',
            'phone' => 'required',
            'network' => 'required|string',
            'staff_id' => 'required|string|unique:cpds',
            'region' => 'required|string',
            'district' => 'required|string',
            'circuit' => 'sometimes|required|string',
        ]);

        $amount=1;
        $response = Http::withHeaders([
            "Authorization" => "Bearer 1|ZGOsCt2lPRNuNdIIgf33TDfVaSseN39vshfd0KlV",
            "Content-Type" => "application/json",
            "Accept" => "application/json"

        ])->post('https://momo.ncopst.org/api/getotp', [
            'amount' => $amount,
            "phone" =>  $data['phone'],
            "network" => $data['network'],
            "purpose" => 'cpd',
        ]);

        $response = json_decode($response, true);

        if($response['status'] == true){
            Payment::create([
                'amount' => $amount,
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
        if($request->getClientIp() != '198.54.115.156') abort(404);

        $payment = Payment::where('reference', $request->reference)->first();

        if($request->status == 'charge.success'){
            $payment->status  = 'Successfull';
            $payment->save();

            Cpd::create([
                'name' => $payment->name,
                'email' => $payment->email,
                'phone' => $payment->phone,
                'network' => $payment->network,
                'staff_id' => $payment->staff_id,
                'region' => $payment->region,
                'district' => $payment->district,
                'circuit' => $payment->circuit,
                'reference' => $payment->reference,
            ]);

        }else{
            $payment->update([
                'status' => $request->status
            ]);
        }
    }
}
