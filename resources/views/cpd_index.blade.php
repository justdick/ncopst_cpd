@extends('layout.app')

@section('content')
  <section id="contact" class="contact">
    <div class="container">
      <div class="row mt-5 justify-content-center" data-aos="fade-up">
        <div class="col-lg-10">

          @include('inc.messages')
          <h3> NATIONAL COUNCIL OF PRIVATE SCHOOL TEACHERS</h3><br>
            <h4>CPD PAYMENT LIST</h4>

            <table id="myTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Staff ID</th>
                            <th>Region</th>
                            <th>District</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Staff ID</th>
                            <th>Region</th>
                            <th>District</th>
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
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'age', name: 'age'},
                {data: 'salary', name: 'salary'},
                {
                    data: 'action',
                    name: 'Attended',
                    orderable: true,
                    searchable: true
                },
            ]
            });
        });
  </script>
  @endsection
