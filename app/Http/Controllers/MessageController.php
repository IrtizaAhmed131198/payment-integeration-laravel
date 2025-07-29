<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // Fetch all messages
    public function index()
    {
        return Message::with('user')->latest()->take(50)->get()->reverse()->values();
    }

    // Store a new message
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $message = Message::create([
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        broadcast(new MessageSent($message->load('user')))->toOthers();

        return response()->json(['status' => 'Message sent!']);
    }
}
