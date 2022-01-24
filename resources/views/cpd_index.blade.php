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
                            <th>Circuit</th>
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
                {data: 'phone', name: 'phone'},
                {data: 'staff_id', name: 'staff_id'},
                {data: 'district', name: 'district'},
                {data: 'circuit', name: 'circuit'},
                {
                    data: 'action',
                    name: 'Attended',
                    orderable: true,
                    searchable: true
                },
            ]
            });
        });



        $('.attended').on('click', '.btn-success[data-remote]', function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var url = $(this).data('remote');
            // confirm then
            $.ajax({
                url: url,
                type: 'DELETE',
                dataType: 'json',
                data: {method: '_PATCH', submit: true}
            }).always(function (data) {
                $('#myTable').DataTable().draw(false);
            });
        });
  </script>
  @endsection
