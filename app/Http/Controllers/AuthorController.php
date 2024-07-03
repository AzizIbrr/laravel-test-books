<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Author = Author::paginate(5)->withQueryString();
        return view("author", ['title' => 'Author', 'authors' => $Author]);
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
            'name' => 'required|min:5',
            'email' => 'required|email:rfc,dns',
        ], [
            'name.required' => 'Judul Wajib di isikan',
            'name.min:5' => 'Judul Minimal 5 Karakter',
            'email.required' => 'Email Harus di isikan',
            'email.email:rfs,dns' => 'Email Tidak Valid',
        ]);
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ];
        Author::create($data);
        return redirect('/author')->with('success', 'Berhasil Menyimpan Data');
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
        $author = Author::findOrFail($id);
        return view('author-edit', ['title' => 'Form Edit Penulis', 'authors' => $author]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|min:5',
            'email' => 'required|email:rfs,dns',
        ], [
            'name.required' => 'Nama Wajib diisi',
            'name.min:5' => 'Judul Minimal 5 Karakter',
            'email.required' => 'Email Harus di isikan',
            'email.email:rfs,dns' => 'Email Tidak Valid',
        ]);
        $author = Author::find($id);
        $author->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);
        return redirect('/author')->with('success', 'Berhasil Merubah Data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Author::where('id', $id)->delete();
        return redirect('author')->with('success', 'Data Berhasil Di Hapus');
    }
}
