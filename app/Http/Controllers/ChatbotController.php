<?php

namespace App\Http\Controllers;

use App\Models\MasterChatbot;
use App\Models\UserChatbot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatbotController extends Controller
{
    public function history()
    {
        return UserChatbot::where('user_id', Auth::id())
            ->orderBy('id')
            ->get();
    }
    public function send(Request $request)
    {
        $text = trim($request->message);

        $data = MasterChatbot::where('pertanyaan', $text)->first();

        $reply = $data
            ? $data->jawaban
            : 'Maaf, saya belum punya jawaban untuk pertanyaan itu.';

        UserChatbot::create([
            'user_id' => Auth::id(),
            'pertanyaan' => $text,
            'jawaban' => $reply
        ]);

        return response()->json([
            'reply' => $reply
        ]);
    }
}
