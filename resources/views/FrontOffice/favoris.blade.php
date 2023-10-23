@extends('FrontOffice.layout')
    @section('content')
    

    




   
        
   
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('../images/bg_2.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs"><span class="mr-2"><a href="/">Home <i class="ion-ios-arrow-forward"></i></a></span> 
                <span class="mr-2"><a href="/event">Events <i class="ion-ios-arrow-forward"></i></a></span><span>Favoris </span></p>
            <h1 class="mb-3 bread">Favoris</h1>
          </div>
        </div>
      </div>
    </section>

    @if (session()->has('message')) 
    <div class="alert alert-success d-flex justify-content-between" role="alert">
      <div>{{session()->get('message')}}</div>
      <div><small><i class="icon-bell"></i> 1 sec ago</small></div>
    </div>
     @endif 
     @if (count($favoris)>0)
<section class="ftco-section ftco-cart">
    <div class="container">
        <div class="row">
        <div class="col-md-12 ftco-animate">
            <div class="car-list">
                <table class="table">
                    <thead class="thead-primary">
                      <tr class="text-center">
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th class="bg-primary heading">Participate</th>
                        <th class="bg-dark heading">Delete</th>
                        <th class="bg-black heading">Details</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($favoris as $favori )
                        @foreach ($favori->events as $event )
                      <tr class="">
                          <td class="car-image"><div class="img" style="background-image:url(/images/{{$event->image_path}});"></div></td>
                        <td class="product-name">
                            <h3>{{$event->title}}</h3>
                            <p class="mb-0 ">
                                <span>Date :</span>
                                <span>{{$event->date_event}}</span>
                                
                            </p>
                        </td>
                        
                        <td class="price">
                            
                              <form action="/participatEvent" method="POST" >
                                @csrf
                                <input type="text" hidden name="event_id" value="{{$event->id}}"/>
                                <p class="btn-custom"><button style="border: none;background: none;cursor: pointer;" type="submit" ><a>
                                  @if ($event->users->contains(Auth::user()))
                                  See receipt
                              @else
                                  Participate
                              @endif  
                                </a> </span></button></p>
                              </form>
                            
                            <div class="price-rate">
                                <h3>
                                    <span class="num"><small class="currency">$</small> Free</span>
                                    
                                </h3>
                                <span class="subheading">Take part in this event !!!</span>
                            </div>
                        </td>
                        
                        <td class="price">
                            <form action="/event/favoris/{{$favori->id}}" method="POST">
                                @csrf
                                @method('delete')
                            <p><button class="btn-custom" style="border: none;background: none;cursor: pointer;" type="submit"><a>Delete</a></button></p>
                            </form>
                            <div class="price-rate">
                                
                                <span class="subheading">Delete this event</span>
                        </div>
                        </td>

                        <td class="price">
                            <p class="btn-custom"><a href="/event/{{$event->id}}">Details</a></p>
                            <div class="price-rate">
                               
                                <span class="subheading">Access the details of this event</span>
                            </div>
                        </td>
                      </tr><!-- END TR-->

                      @endforeach
                      @endforeach

                      

                      


                    

                      
                    </tbody>
                  </table>
              </div>
        </div>
    </div>
    </div>
</section>
@else
<section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center mb-5">
<div class=" col-md-7 heading-section text-center ftco-animate">
    <span class="subheading">Favoris</span>
  <h2>There are no favorites yet.</h2>
  <img  class="img-fluid w-50" src="../images/favoris.png" alt=""/>
</div>
</div>
</div>
</section>
@endif

            
     

@endsection