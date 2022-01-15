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
                        @if ($response['data']['display_text'])
                            {{$response['data']['display_text']}}
                        @else
                            {{$response['display_text']}}
                        @endif

                    </li>
                </h6>
                {{-- <h6><li>You will be redirected to total vote dashboard after Transaction is complete</li></h6> --}}
            </ol> <br><br>

            {{-- will only show when otp needed if not prompt will show on phone --}}
            @if ($response['data']['status'] == 'send_otp')
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

            interval = setInterval(updateDiv,5000);

            function payment_status(){
                $.post("/payment_status",
                {
                    reference: <?php $response['data']['reference'] ?>,
                },
                function(data, status){
                    alert("Data: " + data + "\nStatus: " + status);
                    // clearInterval(interval);
                });
            }
        });
  </script>
@endsection
