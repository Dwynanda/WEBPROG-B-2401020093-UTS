<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForumController extends Controller
{
    private $file = 'data.json';

    public function index()
    {
        $path = storage_path($this->file);
        $posts = file_exists($path) ? json_decode(file_get_contents($path), true) : [];
        return view('index', compact('posts'));
    }

    public function store(Request $request)
    {
        $path = storage_path($this->file);
        $posts = file_exists($path) ? json_decode(file_get_contents($path), true) : [];

        // Jika user memilih "custom", pakai input topik baru
        $topik = $request->topik === 'custom' && $request->filled('topik_baru')
            ? strtolower(trim($request->topik_baru))
            : $request->topik;

        $posts[] = [
            'nama' => $request->nama,
            'isi' => $request->isi,
            'topik' => $topik ?: 'umum',
            'created_at' => now()->format('d M Y H:i'),
            'replies' => []
        ];

        file_put_contents($path, json_encode($posts, JSON_PRETTY_PRINT));
        return redirect()->route('forum.index');
    }

    public function reply(Request $request, $index)
    {
        $path = storage_path($this->file);
        $posts = file_exists($path) ? json_decode(file_get_contents($path), true) : [];

        if (!isset($posts[$index])) {
            return redirect()->route('forum.index');
        }

        $posts[$index]['replies'][] = [
            'nama' => $request->nama,
            'balasan' => $request->balasan,
            'created_at' => now()->format('d M Y H:i')
        ];

        file_put_contents($path, json_encode($posts, JSON_PRETTY_PRINT));
        return redirect()->route('forum.index');
    }
}
