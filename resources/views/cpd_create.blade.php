@extends('layout.app')

@section('content')
  <section id="contact" class="contact">
    <div class="container">
      <div class="row mt-5 justify-content-center" data-aos="fade-up">
        <div class="col-lg-10">

          @include('inc.messages')
          <h2> CPD PAYMENT SYSTEM</h2>

          <form action="{{route('pay')}}" method="POST" role="form">
            @csrf

            <label for="full_name">Full Name</label>
            <div class="form-group">
              <input type="text" class="form-control" name="name" id="name" placeholder="Full Name" data-rule="minlen:5" data-msg="Please enter your Full name" required/>
              <div class="validate"></div>
            </div>

            <label for="phone">MoMo Number</label>
            <div class="form-group">
              <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Momo Number for payment" data-rule="minlen:4" data-msg="Please Enter Momo Number for payment" required/>
              <div class="validate"></div>
            </div>

            <label for="network">Network</label>
            <div class="form-group">
              <select name="network" class="form-control" id="network" required>
                  <option value=""></option>
                  <option value="mtn">MTN</option>
                  <option value="tgo">Tigo</option>
              </select>
            </div>

            <label for="email">Email</label>
            <div class="form-group">
              <input type="email" class="form-control" name="email" id="email" placeholder="Enter email used on NTC Portal" data-rule="minlen:4" data-msg="Please Enter email" required />
              <div class="validate"></div>
            </div>

            <label for="staff_id">Staff ID</label>
            <div class="form-group">
              <input type="staff_id" class="form-control" name="staff_id" id="staff_id" placeholder="Enter Staff ID" data-rule="minlen:4" data-msg="Please Enter Staff ID" required />
              <div class="validate"></div>
            </div>

            <label for="region">Region</label>
            <div class="form-group">
              <select name="region" class="form-control" id="region" required>
                  <option value=""></option>
                  <option value="ashanti">Ashanti</option>
                  <option value="central">Central</option>
              </select>
            </div>

            <label for="district">District</label>
            <div class="form-group">
              <select name="district" class="form-control" id="district" required>
                  <option value=""></option>
              </select>
            </div>

            <div class="circuit">
                <label for="circuit">Circuit</label>
                <div class="form-group">
                    <select name="circuit" class="form-control" id="circuit" required>
                        <option value=""></option>
                    </select>
                </div>
            </div>

            <button class="btn btn-success " type="submit">Submit</button>

          </form>
        </div>

      </div>

    </div>
  </section><!-- End Contact Section -->

    <script>
        $(document).ready(function(){
            $('#region').change(function(e){
                let region = $('#region').val();
                var district = $('#district');
                var circuit = $('#circuit');
                var divcircuit = $('.circuit');
                switch (region) {
                    case 'ashanti':
                        district.html(
                            `<option value=""></option>
                            <option value="kwabre_east">Kwabre East</option>`
                        );

                        circuit.html(
                            `<option value=""></option>`
                        );
                        circuit.prop('required', false);
                        circuit.attr('name', '');
                        divcircuit.hide();
                        break;

                    case 'central':
                        district.html(
                            `<option value="aboura_aseibu_kwaman_kesse">Aboura Aseibu Kwaman Kesse</option>`
                        );
                        divcircuit.show();

                        circuit.html(
                            `<option value=""></option>
                            <option value="AYELDU">AYELDU</option>
                            <option value="ASEBU">ASEBU</option>
                            <option value="ABAKRAMPA">ABAKRAMPA</option>
                            <option value="ASUANSI">ASUANSI</option>
                            <option value="GYABANKROM">GYABANKROM</option>
                            <option value="MOREE">MOREE</option>
                            <option value="ABURA DUNKWA">ABURA DUNKWA</option>`
                        );

                        circuit.prop('required', true);
                        circuit.attr('name', 'circuit');

                        break;

                    default:
                        district.html(
                            `<option value=""></option>`
                        );

                        circuit.html(
                            `<option value=""></option>`
                        );
                        circuit.attr('name', '');
                        divcircuit.hide();

                        break;
                }
            })
        });
    </script>
  @endsection
