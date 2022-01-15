@extends('layout.app')

@section('content')



  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Contestants</h2>
          <ol>
            <li><a href="{{route('pageant.create')}}">Home</a></li>
            <li>Contestants</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Our Team Section ======= -->
    <section id="team" class="team section-bg">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2><span style="color: orange;">NCOPST</span> <strong>BEAUTY PAGEANT</strong></h2>
          <p>These are the selected contestants for the most beautiful Private School Teacher happening live at </p>
        </div>

        <div class="row">
            @if (count($pageants) > 0)
                @foreach ($pageants as $pageant)
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                        <a href="{{route('pageant.show', $pageant->id)}}">
                            <div class="member" data-aos="fade-up">
                                <div class="member-img">
                                    <img src="{{asset('pageant_images/' . $pageant->image)}}" class="img-fluid" alt="">
                                    <div class="social">
                                    <a href=""><i class="icofont-twitter"></i></a>
                                    <a href=""><i class="icofont-facebook"></i></a>
                                    <a href=""><i class="icofont-instagram"></i></a>
                                    <a href=""><i class="icofont-linkedin"></i></a>
                                    </div>
                                </div>
                                <div class="member-info">
                                    <h4>{{$pageant->firstname ." ". $pageant->lastname}}</h4>
                                    <button class="btn btn-sm btn-success">Vote</button>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>


      </div>
    </section><!-- End Our Team Section -->

  </main><!-- End #main -->
@endsection()
