<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\MasterChatbot;
use Illuminate\Http\Request;


class MasterChatbotController extends Controller
{
    public function index()
    {
        $data = MasterChatbot::latest()->get();
        return view('master_chatbots.index', compact('data'));
    }

    public function create()
    {
        return view('master_chatbots.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required',
            'jawaban' => 'required'
        ]);

        MasterChatbot::create([
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => $request->jawaban
        ]);

        return redirect()->route('master_chatbots.index')
            ->with('success', 'master chatbot berhasil dibuat');
    }

    public function edit(MasterChatbot $master_chatbot)
    {
        return view('master_chatbots.edit', compact('master_chatbot'));
    }

    public function update(Request $request, MasterChatbot $master_chatbot)
    {
        $request->validate([
            'pertanyaan' => 'required',
            'jawaban' => 'required'
        ]);

        $data = $request->only('pertanyaan', 'jawaban');

        $master_chatbot->update($data);

        return redirect()->route('master_chatbots.index')
            ->with('success', 'Master Chatbot berhasil diupdate');
    }

    public function destroy(MasterChatbot $master_chatbot)
    {
        $master_chatbot->delete();

        return back()->with('success', 'Master Chatbot berhasil dihapus');
    }
}
