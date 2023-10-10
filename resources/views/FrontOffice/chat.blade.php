
@extends('FrontOffice.layout')
@section('content')


<section class="ftco-section contact-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <!-- User list -->
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
                <!-- Chat area -->
                <div class="card">
                    <div class="card-header">Chat</div>
                    <div class="card-body">
                        <!-- Display chat messages here -->
                        <div class="chat-box">
                            @if($receiverId)
                            <div class="chat-header">
                                <h5>Chatting with {{ $receiverName }}</h5>
                            </div>
                            <div class="chat-messages">
                                @foreach($messages as $message)
                                @if($message->user_id == auth()->user()->id)
                                <div class="message sent">
                                    {{ $message->content }}
                                </div>
                                @else
                                <div class="message received">
                                    {{ $message->content }}
                                </div>
                                @endif
                                @endforeach
                            </div>
                            <div class="chat-input">
                                <!-- Message input form -->
                                <form action="{{ route('chat.sendMessage') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="receiver_id" value="{{ $receiverId }}">
                                    <input type="text" name="message" class="form-control"
                                        placeholder="Type your message...">
                                    <button type="submit" class="btn btn-primary">Send</button>
                                </form>
                            </div>
                            @else
                            <div class="no-chat-selected">
                                <p>Select a user to start a conversation.</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
