@extends('layout.app')

@section('content')
  <section id="contact" class="contact">
    <div class="container">
      <div class="row mt-5">
        <div class="col-sm-6"><br>
            <h5>Read Instruction below</h5><br>

            <ol>
                <h6>
                    <li>
                        @if (isset($response['data']['display_text']))
                            {{$response['data']['display_text']}}
                        @else
                            {{$response['data']['message']}}
                        @endif
                    </li>

                    {{-- <li>
                        You will be directed to login page if payment is Successfull
                    </li> --}}
                </h6>
            </ol> <br><br>

            {{-- will only show when otp needed if not prompt will show on phone --}}
            @if (isset($response['data']['status']) && $response['data']['status'] == 'send_otp')
                <form action="{{route('send_otp')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="otp"> <strong>Enter OTP </strong></label>

                        <input type="number" class="form-control" name="otp" id="otp" value="{{old('otp')}}" min="1" required/>
                        <input type="hidden" name="reference" value="{{$response['data']['reference']}}">

                    </div>

                    <div class="form-group">
                        <button class="btn btn-sm btn-success">Submit</button>
                    </div>
                </form>
            @endif

        </div>


        {{-- <div class="col-sm-6">
            <img src="{{asset('pageant_images/' . session('pageant_image'))}}" class="img-fluid" alt=""> <br><br>
        </div> --}}

      </div>

    </div>
  </section><!-- End Contact Section -->

    <script>
        $(document).ready(function(){
            var interval = null;

            interval = setInterval(payment_status,10000);

            function payment_status(){
                $.post("https://cpd.ncopst.org/payment_status",
                {
                    reference: "<?php echo $response['data']['reference'] ?>",

                },
                function(data, status){
                    if(data == 'Successfull'){
                        alert('Payment ' + data);

                        clearInterval(interval);

                        location.assign('https://cpd.ncopst.org/login');
                    }

                    //
                });
            }
        });
  </script>
@endsection
