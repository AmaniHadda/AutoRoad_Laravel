@extends('FrontOffice.layout')
@section('content')  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.6.0/css/all.min.css" integrity="sha512-ykRBEJhyZ+B/BIJcBuOyUoIxh0OfdICfHPnPfBy7eIiyJv536ojTCsgX8aqrLQ9VJZHGz4tvYyzOM0lkgmQZGw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('../images/bg_2.jpg');" data-stellar-background-ratio="0.5">
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
<section class="ftco-section ftco-degree-bg">
    <div class="container">
      <div class="row">
        <div class="col-md-8 order-md-last ftco-animate">
          @if(session()->has('message'))

          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{session()->get('message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
          <h2 class="mb-3">{{GoogleTranslate::trans($b->title,app()->getLocale())}}</h2>  
          <div class="d-flex justify-content-start align-items-center">
            <div style="font-size: 15px"><p ><span class="icon-settings mr-1"></span> {{GoogleTranslate::trans("Traduire en ",app()->getLocale())}}</p></div>
            <div style="width: 20% ; margin-top: -18px; margin-left: 12px">
            <select class="changeLang custom-select custom-select-sm" >
              <option value="en" {{session()->get('locale') =='en'?'selected':''}}>English</option>
              <option value="fr" {{session()->get('locale') =='fr'?'selected':''}}>Frensh</option>
              <option value="es" {{session()->get('locale') =='es'?'selected':''}}>Spanish</option>
            </select>
          </div></div>
          
            <div class="meta" style="font-size: 12px">On {{date('d-m-Y', strtotime($b->created_at))}} By {{$b->user->name}}</div>
          <p>{{GoogleTranslate::trans($b->description,app()->getLocale())}}</p>          
          <p>
            <img src="../images/blogs/{{$b->image}}" alt="" class="img-fluid">
          </p>
         
        <div class="d-flex align-items-center justify-content-end" style="background-color: #f2f2f2; padding: 10px;">
          <p style="font-size: 18px; margin-right: 10px;">{{GoogleTranslate::trans("Share this blog on social media ",app()->getLocale())}} !</p>
          <ul class="ftco-footer-social" style="list-style: none; padding: 0;">
              {!! $shareButtons !!}
          </ul>
      </div>
      

          <div class="pt-5">
            @if ($nbComments>0)
            <h3 class="mb-5">{{$nbComments}} {{GoogleTranslate::trans("Comments")}}</h3>
            <ul class="comment-list">
              @foreach ($c as $comment)
              <li class="comment">
                <div class="vcard bio">
                  <img src="../images/person_1.gif" alt="Image placeholder">
                </div>
                <div class="comment-body">
                  <h3>{{$comment->user->name}}</h3>
                  <div class="meta">On {{date('d-m-Y', strtotime($comment->created_at))}}</div>
                  <p>{{GoogleTranslate::trans($comment->message,app()->getLocale())}}</p>
                
                  <p class="d-flex align-items-center">{{ count(json_decode($comment->likes, true)) }}<span class="icon-heart ml-1" style="  color: rgb(232, 67, 67);"></span></p>
                  @if (Auth::user() )                
                  <div class="d-flex justify-content-start align-items-center">
                    @if (Auth::user()->id==$comment->user_id)
                        
                    <div class="">
                      <button type="submit" class="edit btn btn-black btn-outline-black ml-1">Edit</a>
                      </div>
                      <form action="/comments/update/{{$comment->id}}/{{$b->id}}" method="POST" class="p-3 bg-light" style="display: none;" id="editForm">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                          <label for="message">Comment</label>
                          <textarea id="message" name="message" cols="30" rows="2" class="form-control">{{$comment->message}}</textarea>
                        </div>
                        <div class="text-danger">
                          @error('message')
                              <p><i class='bx bx-error-circle'></i>{{$message}}</p>
                          @enderror
                        </div>
                          <div class="form-group">
                            <input type="submit" value="Edit Comment" class="btn py-2 px-2 btn-primary">
                          </div>
                      </form>
                    @endif
                    @if (Auth::user()->id==$comment->user_id)
                    <div>
                      <form action="/comments/{{$comment->id}}/{{$b->id}}" method="post">
                        @csrf
                        @method('delete')
                      <button type="submit" class="btn btn-black btn-outline-black ml-1">Delete</button>
                      </form>
                    </div>
                    @endif 
                    @if (is_array(json_decode($comment->likes, true)) && in_array(auth()->user()->id, json_decode($comment->likes, true)))
                    <div>
                      <form action="/comments/unlike/{{$comment->id}}/{{$b->id}}" method="post">
                        @csrf
                      <button type="submit" class="btn btn-black btn-outline-black ml-1"><span class="icon-heart mr-2" ></span>unLike</button>
                      </form>
                    </div>   
                    @else
                    <div>
                      <form action="/comments/likes/{{$comment->id}}/{{$b->id}}" method="post">
                        @csrf
                      <button type="submit" class="btn btn-black btn-outline-black ml-1"><i class="icon-heart mr-2" style="  color: lightgray;"></i>Like</button>
                      </form>
                    </div>   
                    @endif 
                    
                  </div>
                 
                  @endif
                </div>
              </li> 
              @endforeach  
            
            @endif
            
             
            </ul>
            <!-- END comment-list -->
            
            <div class="comment-form-wrap pt-5">
              <h3 class="mb-2">Leave a comment</h3>
              <form action="/comments/{{$b->id}}" method="POST" class="p-3 bg-light">
                @csrf
                <div class="form-group">
                  <label for="message">Comment</label>
                  <textarea id="message" name="message" cols="30" rows="4" class="form-control"></textarea>
                </div>
                <div class="text-danger">
                  @error('message')
                      <p><i class='bx bx-error-circle'></i>{{$message}}</p>
                  @enderror</div>
                <div class="form-group">
                  <input type="submit" value="Post Comment" class="btn py-3 px-4 btn-primary">
                </div>

              </form>
            </div>
          </div>

        </div> <!-- .col-md-8 -->
        <div class="col-md-4 sidebar ftco-animate">
          {{-- <div class="sidebar-box">
            <form action="#" class="search-form">
              <div class="form-group">
                <span class="icon icon-search"></span>
                <input type="text" class="form-control" placeholder="Type a keyword and hit enter">
              </div>
            </form>
          </div> --}}
          <div class="sidebar-box ftco-animate">
            <h3>Recent Blog</h3>
            @foreach ($recentBlogs as $item)               
            <div class="block-21 mb-4 d-flex">
              <a class="blog-img mr-4" style="background-image: url(../images/blogs/{{$item->image}});"></a>
              <div class="text">
                <h3 class="heading"><a href="/blog/{{$item->id}}"><?php echo substr($b->description, 0, 50); ?>...</a></h3>
                <div class="meta">
                  <div><a href="#"><span class="icon-calendar"></span> {{date('d-m-Y', strtotime($item->created_at))}}</a></div>
                  <div><a href="#"><span class="icon-person"></span> {{$item->user->name}}</a></div>
                  {{-- <div><a href="#"><span class="icon-chat"></span> {{$nbComments}}</a></div> --}}
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>

      </div>
    </div>
  </section> <!-- .section -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function () {
      $(".edit").click(function () {
        $("#editForm").toggle();
      });
    });
    var url="{{route('changeLang')}}";
    $('.changeLang').change(function(event){
      window.location.href= url+"?lang="+$(this).val();
    })
    </script>
    
@endsection