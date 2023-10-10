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
        $users = User::where('id', '!=', auth()->id())->get();
    
        $messages = [];
        $receiverId = null;
        $receiverName = '';
    
        if ($request->has('receiver_id')) {
            $receiverId = $request->receiver_id;
            $receiver = User::find($receiverId);
    
            if ($receiver) {
                $receiverName = $receiver->name; 
    
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
        $request->validate([
            'message' => 'required|string',
            'receiver_id' => 'required|exists:users,id',
        ]);

        $message = new Chat();
        $message->user_id = auth()->id();
        $message->receiver_id = $request->receiver_id;
        $message->message = $request->message;
        $message->save();

        return redirect()->route('chat', ['receiver_id' => $request->receiver_id])
            ->with('success', 'Message sent successfully');
    }
}
