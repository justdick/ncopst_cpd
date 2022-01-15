@extends('layout.app')

@section('content')
  <section id="contact" class="contact">
    <div class="container">
      <div class="row mt-5">
        <div class="col-sm-6"><br>
            <h6>Read Instruction then scroll down to cast vote</h6>
            <ol>
                <li>Either enter amount to pay or number of votes</li>
                <li>Enter Phone Number </li>
                <li>Select Network</li>
                <li>Click Proceed to pay</li>
            </ol>

            <strong>NB: You may Receive OTP code to be entered or Receive a direct authorization prompt on your phone to enter Your MoMo pin to complete transaction</strong>
        </div>


        <div class="col-sm-6">

          @include('inc.messages')

          <form action="{{route('vote')}}" method="POST" role="form" class="php-email-form" enctype="multipart/form-data">
            <img src="{{asset('pageant_images/' . $pageant->image)}}" class="img-fluid" alt=""> <br><br>

            @csrf

            <div class="form-group">
                <label for="amount"> <strong>Enter Amount To Pay (GHS) </strong></label>

                <input type="number" class="form-control" name="amount" id="amount" value="{{old('amount')}}" min="1" step="0.5" required/>

                <div class="validate"></div>
            </div>

            <div class="form-group">
                <label for="no_of_votes"> <strong>Enter No of Votes </strong></label>
                <input type="number" class="form-control" name="no_of_votes" id="no_of_votes" min="1" step="1" value="{{old('no_of_votes')}}" required/>

                <div class="validate"></div>
            </div>

            <div class="form-group">
                <label for="phone"> <strong>MoMo Number </strong></label>
                <input type="text" class="form-control" name="phone" id="phone" value="{{old('phone')}}" required/>

            </div>

            <div class="form-group">
                <label for="phone"> <strong>Select Network</strong></label>
                <select class="form-control" name="network" id="network" required>
                    <option> </option>
                    <option value="mtn">MTN</option>
                    <option value="tgo">Tigo</option>
                </select>
            </div>
            <input type="hidden" name="id" value="{{$pageant->id}}">
            <div class="text-center"><button type="submit">Proceed To Pay</button></div>

          </form>
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
  </script>
  @endsection
