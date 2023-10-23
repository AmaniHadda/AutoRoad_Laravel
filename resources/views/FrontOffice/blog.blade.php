
    @extends('FrontOffice.layout')
    @section('content')
    
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Blog <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-3 bread">Read our blog</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section">
      <div class="container">
        <div class="row d-flex justify-content-center">
          @foreach ($listBlogs as $b)
              
          <div class="col-md-10 text-center d-flex ftco-animate">
          	<div class="blog-entry justify-content-end">
              <a href="blog-single.html" class="block-20 img" style="background-image: url('images/blogs/{{$b->image}}');">
              </a>
              <div class="text pt-4">
              	<div class="meta mb-3">
                  <div><a href="/blog/{{$b->id}}" > {{date('d-m-Y', strtotime($b->created_at))}}</a></div>
                  <div><a href="/blog/{{$b->id}}" >{{$b->user->name}}</a></div>
                </div>
                <h3 class="heading mt-2"><a href="/blog/{{$b->id}}">{{$b->title}}</a></h3>
                <p><?php echo substr($b->description, 0, 250); ?>...</p>
                <p><a href="/blog/{{$b->id}}" class="btn-custom">Continue <span class="icon-long-arrow-right"></span></a></p>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        
      </div>
    </section>

   @endsection