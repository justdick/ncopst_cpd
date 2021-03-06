@extends('layout.app')

@section('content')
  <section id="contact" class="contact">
    <div class="container">
      <div class="row mt-5 justify-content-center" data-aos="fade-up">
        <div class="col-sm-12">

          @include('inc.messages')
          <h3> NCOPST CPD SERVICE PROVIDER </h3><br>
            <h4>CPD PAYMENT LIST</h4>

            <table id="myTable" class="display table table-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Region</th>
                            <th>District</th>
                            <th>Date</th>
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
                            <th>District</th>
                            <th>Date</th>
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
                {data: 'district', name: 'district'},
                {data: 'created_at', name: 'date'},
                {
                    data: 'action',
                    name: 'Paid',
                    order: true,
                    searchable: true
                },
            ],

            });
        });

  </script>
  @endsection
