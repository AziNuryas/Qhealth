<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question; 
use App\Models\Answer; // Pastikan model Answer sudah ada
use Illuminate\Support\Facades\DB;

class AdminAnswerController extends Controller
{
    // Menampilkan daftar jawaban
    public function index()
    {
        // Ambil semua jawaban dari database
        $answers = Answer::all();
        
        // Kirim data ke view
        return view('admin.answers.index', compact('answers'));
    }

    // Menampilkan form untuk membuat jawaban baru
    public function create()
    {
        return view('admin.answers.create');
    }

    // Menyimpan jawaban baru
    public function store(Request $request)
    {
        // Validasi data yang dikirimkan
        $validated = $request->validate([
            'answer_text' => 'required|string|max:255',
            'question_id' => 'required|exists:questions,id', // Misal ada tabel 'questions'
        ]);

        // Simpan data jawaban baru
        Answer::create([
            'answer_text' => $validated['answer_text'],
            'question_id' => $validated['question_id'],
        ]);

        // Kembali ke halaman daftar jawaban dengan pesan sukses
        return redirect()->route('admin.answers.index')->with('success', 'Jawaban berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit jawaban
    public function edit($id)
    {
        $answer = Answer::findOrFail($id);
        return view('admin.answers.edit', compact('answer'));
    }

    // Memperbarui jawaban
    public function update(Request $request, $id)
    {
        // Validasi data yang dikirimkan
        $validated = $request->validate([
            'answer_text' => 'required|string|max:255',
        ]);

        // Cari jawaban berdasarkan ID
        $answer = Answer::findOrFail($id);

        // Update jawaban dengan data baru
        $answer->update([
            'answer_text' => $validated['answer_text'],
        ]);

        // Kembali ke halaman daftar jawaban dengan pesan sukses
        return redirect()->route('admin.answers.index')->with('success', 'Jawaban berhasil diperbarui.');
    }

    // Menghapus jawaban
    public function destroy($id)
    {
        // Cari jawaban berdasarkan ID
        $answer = Answer::findOrFail($id);

        // Hapus jawaban
        $answer->delete();

        // Kembali ke halaman daftar jawaban dengan pesan sukses
        return redirect()->route('admin.answers.index')->with('success', 'Jawaban berhasil dihapus.');
    }

    public function show($id)
{
    $answer = Answer::findOrFail($id); // Asumsinya model Answer ada
    return view('admin.answers.show', compact('answer'));
}

}
