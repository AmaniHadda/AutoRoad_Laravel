<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function chat(Request $request)
    {
        // Get all users except the authenticated user
        $users = User::where('id', '!=', auth()->id())->get();
    
        // Initialize variables
        $messages = [];
        $receiverId = null;
        $receiverName = '';
    
        // Check if a user is selected
        if ($request->has('receiver_id')) {
            $receiverId = $request->receiver_id;
            $receiver = User::find($receiverId);
    
            if ($receiver) {
                $receiverName = $receiver->name; // Get the receiver's name
    
                // Fetch messages between the authenticated user and the selected user
                $messages = Chat::whereIn('user_id', [auth()->id(), $receiverId])
                    ->whereIn('receiver_id', [auth()->id(), $receiverId])
                    ->orderBy('created_at', 'asc')
                    ->get();
            }
        }
    
        return view('FrontOffice.chat', compact('users', 'messages', 'receiverId', 'receiverName'));
    }
    

    public function sendMessage(Request $request)
    {
        // Validate the request
        $request->validate([
            'message' => 'required|string',
            'receiver_id' => 'required|exists:users,id',
        ]);

        // Create a new chat message
        $message = new Chat();
        $message->user_id = auth()->id();
        $message->receiver_id = $request->receiver_id;
        $message->message = $request->message;
        $message->save();

        return redirect()->route('chat', ['receiver_id' => $request->receiver_id])
            ->with('success', 'Message sent successfully');
    }
}
