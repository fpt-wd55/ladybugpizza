<?php

namespace App\Http\Controllers\Admin;

use App\Events\ChatBroadcast;
use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $userIds = Conversation::select('user_id_2')->distinct()->pluck('user_id_2');
        $users = [];
        foreach ($userIds as $userId) {
            $users[] = User::find($userId);
        }

        return view('admins.message.index', compact('users'));
    }

    public function store(Request $request)
    {
        // Assuming you have a user authenticated
        $user = auth()->user();

        // Broadcast the message
        event(new ChatBroadcast($user, $request->message));

        return response()->json(['status' => 'Message sent successfully']);
    }

    public function show(User $user) {}
}
