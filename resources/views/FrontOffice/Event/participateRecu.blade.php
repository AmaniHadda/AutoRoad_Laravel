
@extends('FrontOffice.layout')
@section('content')

<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('../images/bg_2.jpg');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
      <div class="col-md-9 ftco-animate pb-5">
          <p class="breadcrumbs"><span class="mr-2"><a href="/">Home <i class="ion-ios-arrow-forward"></i></a></span> 
            <span class="mr-2"><a href="/event">event <i class="ion-ios-arrow-forward"></i></a></span>
            <span>Received</span>
        </p>
        <h1 class="mb-3 bread">Event details</h1>
      </div>
    </div>
  </div>
</section>
@if (isset($message)) 
    <div class="alert alert-success d-flex justify-content-between" role="alert">
      <div>{{$message}}</div>
      <div><small><i class="icon-bell"></i> 1 sec ago</small></div>
    </div>
     @endif 
     <section class="ftco-section">
        <div class="container">
          <div class="row justify-content-center mb-5">
            <div class="col-md-6 heading-section text-center ftco-animate">
            <span class="subheading">Received</span>
          <h2>Participation was successful</h2>
        </div>
        </div>

        
        <div class="card">
            <div class="card-body">   
        <div class="container bootdey">
            <div class="row invoice row-printable">
                <div class="offset-md-1 col-md-10">
                    <!-- col-lg-12 start here -->
                    <div class="panel panel-default plain" id="dash_0">
                        <!-- Start .panel -->
                        <div class="panel-body p30">
                            <div class="row">
                                <!-- Start .row -->
                                <div class="col-lg-6">
                                    <!-- col-lg-6 start here -->
                                    <div class="invoice-logo"><img width="100" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Invoice logo"></div>
                                </div>
                                <!-- col-lg-6 end here -->
                                <div class="col-lg-6">
                                    <!-- col-lg-6 start here -->
                                    <div class="invoice-from">
                                        <ul class="list-unstyled text-right">
                                            <li>AutoRoad</li>
                                            <li>Pôle Technologique - El Ghazala</li>
                                            <li>RECEIVED N° 826113958</li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- col-lg-6 end here -->
                                <div class="col-lg-12">
                                    <!-- col-lg-12 start here -->
                                    <div class="invoice-details mt25">
                                        <div class="well">
                                            <ul class="list-unstyled mb0">
                                                <li><strong>Name</strong> {{$user->name}}</li>
                                                <li><strong>Joining Date</strong> {{$user->created_at}}</li>
                                                <li><strong>Email</strong> {{$user->email}}</li>
                                                <li><strong>Status:</strong> <span class="label label-danger">ACTIF</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="invoice-to mt25">
                                        <ul class="list-unstyled">
                                            <li><strong>Event :</strong></li>
                                            <li>{{$event->title}}</li>
                                            <li>The date of this event is : {{$event->date_event}}</li>
                                            <li>Event created on : {{$event->created_at}}</li>
                                            <li>TUN</li>
                                        </ul>
                                    </div>
                                    @php
                                        $date = now()->format('Y-m-d');
                                    @endphp

                                    
                                    <div class="invoice-footer mt25">
                                        <p class="text-center">Generated on {{ $date }}  </p>
                                        <form action="/generatepdf" method="POST" style="display: flex; justify-content: end;">
                                            @method("GET")
                                            @csrf
                                            <input type="text" hidden name="event_id" value="{{$event->id}}"/>
                                            <button style="font-size: 18px" type="submit" href="#" class="btn btn-primary "> Print <span class="icon-print ml-1"></span></button>
                                        </form>
                                    </div>
                                </div>
                                <!-- col-lg-12 end here -->
                            </div>
                            <!-- End .row -->
                        </div>
                    </div>
                    <!-- End .panel -->
                </div>
                <!-- col-lg-12 end here -->
            </div>
            </div>
                       
                
            
            
            
            
            
        </div>
    </div>
    <p class="d-flex justify-content-end"><a href="/event" class="btn">Return<span class="icon-long-arrow-right"></span></a></p>
</div>
      </div>
  </div>
</section>

@endsection