<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $books = Book::all();
        return Inertia::render('Welcome', [
       "auth" => [
         'name' => 'John Doe',
        'age' => 30,
       ]
    ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //$this-
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request-> validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'nullable'
        ]);
        Book::create($request->all());
        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'nullable'
        ]);
        $books = Book::find($id);
        $books->update($request->all());
        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $books = Book::find($id);
        $books->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
