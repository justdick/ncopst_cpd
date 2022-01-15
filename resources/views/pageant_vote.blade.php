@extends('layout.app')

@section('content')
  <section id="contact" class="contact">
    <div class="container">
      <div class="row mt-5">
        <div class="col-sm-6"><br>
            <h5>Read Instruction below</h5><br>

            <ol>
                <h6><li>{{$response['data']['display_text']}}</li></h6>
                {{-- <h6><li>You will be redirected to total vote dashboard after Transaction is complete</li></h6> --}}
            </ol> <br><br>

            @if ($response['data']['status'] == 'send_otp')
                <form action="{{route('send_otp')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="otp"> <strong>Enter OTP </strong></label>

                        <input type="number" class="form-control" name="otp" id="otp" value="{{old('otp')}}" min="1" required/>
                        <input type="hidden" name="reference" value="{{$response['data']['reference']}}">
                    </div>
                </form>
            @endif

        </div>


        <div class="col-sm-6">
            <img src="{{asset('pageant_images/' . session('pageant_image'))}}" class="img-fluid" alt=""> <br><br>
        </div>

      </div>

    </div>
  </section><!-- End Contact Section -->

    <script>
      $(document).ready(function(){
        $("#no_of_votes").keyup(function(){
            var no_of_votes = Math.round($(this).val()); //round down or up to whole number
            $("#no_of_votes").val(no_of_votes); //update field

            var amount = no_of_votes * 0.5;
            $('#amount').val(amount);
        });



        $("#amount").keyup(function(){
            var amount = Math.round($(this).val()*2) / 2 ; // step 0.5
            if(amount < 1){
                amount = 1;
                $("#amount").val(amount); //update field
            }else{
                $("#amount").val(amount); //update field
            }

            var no_of_votes = amount * 2;
            $('#no_of_votes').val(no_of_votes);
        });
    });


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


  </script>
@endsection
