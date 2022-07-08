@extends('layout.app')

@section('content')
  <section id="contact" class="contact">
    <div class="container">
      <div class="row mt-5 justify-content-center" data-aos="fade-up">
        <div class="col-sm-12">

          @include('inc.messages')
          <h3> NATIONAL COUNCIL OF PRIVATE SCHOOL TEACHERS</h3><br>
            <h4>CPD PAYMENT LIST</h4>

            <table id="myTable" class="display table table-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Region</th>
                            <th>staff_id</th>
                            {{-- <th>Circuit</th> --}}
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Region</th>
                            <th>staff_id</th>
                            {{-- <th>Circuit</th> --}}
                            <th>Status</th>
                        </tr>
                    </tfoot>
                </table>
        </div>

      </div>

    </div>
  </section><!-- End Contact Section -->

  <script>
        $(function () {

            var table = $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('cpd.index') }}",
            columns: [
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'region', name: 'region'},
                {data: 'staff_id', name: 'staff_id'},
                // {data: 'circuit', name: 'circuit'},
                {
                    data: 'action',
                    name: 'Paid',
                    orderable: true,
                    searchable: true
                },
            ]
            });
        });

  </script>
  @endsection
