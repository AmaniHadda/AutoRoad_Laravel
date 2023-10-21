@extends('FrontOffice.layout')
@section('content')

<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
        <div class="col-md-9 ftco-animate pb-5">
            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Chat <i class="ion-ios-arrow-forward"></i></span></p>
          <h1 class="mb-3 bread">Chat</h1>
        </div>
      </div>
    </div>
  </section>

<section class="ftco-section contact-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">User List</div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($users as $user)
                            <li class="list-group-item">
                                <a href="{{ route('chat', ['receiver_id' => $user->id]) }}">
                                    {{ $user->name }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Chatting with {{ $receiverName }}</div>
                    <div class="card-body">
                        <div class="chat-box">
                            <div class="chat-header">
                                @if($receiverId)
                                @else
                                <h5>Select a user to start a conversation.</h5>
                                @endif
                            </div>
                            <div class="chat-messages" style="max-height: 400px; overflow-y: auto; overflow-x: hidden;">
                                @foreach($messages as $message)
                                @if($message->user_id == auth()->user()->id)
                                <div class="row justify-content-end mb-2">
                                    <div class="col-6">
                                        <div class="message sent bg-primary text-white rounded p-2">
                                            {{ $message->message }}
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="row mb-2">
                                    <div class="col-6">
                                        <div class="message received bg-light rounded p-2">
                                            {{ $message->message }}
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                            
                            <div class="chat-input">
                                @if($receiverId)
                                <form action="{{ route('chat.sendMessage') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="receiver_id" value="{{ $receiverId }}">
                                    <div class="input-group">
                                        <textarea name="message" class="form-control" rows="1" placeholder="Type your message..."></textarea>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary">Send</button>
                                        </div>
                                    </div>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
