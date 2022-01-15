<div class="col-lg-4">

    <div class="sidebar" data-aos="fade-left">

      <h3 class="sidebar-title">Search</h3>
      <div class="sidebar-item search-form">
        <form action="">
          <input type="text">
          <button type="submit"><i class="icofont-search"></i></button>
        </form>

      </div><!-- End sidebar search formn-->

      <h3 class="sidebar-title">Recent Posts</h3>
      <div class="sidebar-item recent-posts">
        @if (count($posts)>0)
            @foreach ($posts as $post)
                <div class="post-item clearfix">
                    <img src="{{asset('images/' . $post->image_path)}}" alt="">
                    <h4><a href="blog-single.html">{{$post->title}}</a></h4>
                    <time datetime="2020-01-01">{{$post->created_at}}</time>
                </div>
            @endforeach
        @endif

      </div><!-- End sidebar recent posts-->

      <h3 class="sidebar-title">Tags</h3>
      <div class="sidebar-item tags">
        <ul>
          <li><a href="#">App</a></li>
          <li><a href="#">IT</a></li>
          <li><a href="#">Business</a></li>
          <li><a href="#">Business</a></li>
          <li><a href="#">Mac</a></li>
          <li><a href="#">Design</a></li>
          <li><a href="#">Office</a></li>
          <li><a href="#">Creative</a></li>
          <li><a href="#">Studio</a></li>
          <li><a href="#">Smart</a></li>
          <li><a href="#">Tips</a></li>
          <li><a href="#">Marketing</a></li>
        </ul>

      </div><!-- End sidebar tags-->

    </div><!-- End sidebar -->

  </div><!-- End blog sidebar -->
