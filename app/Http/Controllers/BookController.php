<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Pagination\PaginationServiceProvider;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::paginate(7)->withQueryString();
        $Author = Author::all();
        return view("dashboard", ['title' => 'Book', 'author' => $Author, 'books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:5|max:100',
            'serial_number' => 'required|min:5',
            'published_at' => 'required',
            'author_id' => 'required'
        ], [
            'title.required' => 'Judul Wajib di isikan',
            'title.min:5' => 'Judul Minimal 5 Karakter',
            'serial_number.required' => 'Serial Number Masih Kosong',
            'serial_number.min:5' => 'Serial Number minimal 5 Karakter',
            'published_at.required' => 'Silahkan Masukkan Tanggal Publikasi',
            'author_id.required' => 'Silahkan Pilih Penulis',
        ]);
        $data = [
            'title' => $request->input('title'),
            'serial_number' => $request->input('serial_number'),
            'author_id' => $request->input('author_id'),
            'published_at' => $request->input('published_at'),
        ];
        Book::create($data);
        return redirect('/')->with('success', 'Berhasil Menyimpan Data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $books = Book::findOrFail($id);
        $Author = Author::all();
        return view("book-edit", ['title' => 'Edit Data Buku', 'authors' => $Author, 'books' => $books]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|min:5|max:100',
            'serial_number' => 'required|min:5',
            'published_at' => 'required',
            'author_id' => 'required'
        ], [
            'title.required' => 'Judul Wajib di isikan',
            'title.min:5' => 'Judul Minimal 5 Karakter',
            'serial_number.required' => 'Serial Number Masih Kosong',
            'serial_number.min:5' => 'Serial Number minimal 5 Karakter',
            'published_at.required' => 'Silahkan Masukkan Tanggal Publikasi',
            'author_id.required' => 'Silahkan Pilih Penulis',
        ]);
        $book = Book::find($id);
        $book->update([
            'title' => $request->input('title'),
            'serial_number' => $request->input('serial_number'),
            'author_id' => $request->input('author_id'),
            'published_at' => $request->input('published_at'),
        ]);

        return redirect('/')->with('success', 'Berhasil Merubah Data Buku');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Book::where('id', $id)->delete();
        return redirect('/')->with('success', 'Data Berhasil Di Hapus');
    }
}
