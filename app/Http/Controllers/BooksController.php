<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Exception;
use Log;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::orderBy('created_at', 'desc')->paginate(6);
        return view('pages.books.list', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|unique:books|max:255',
                'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'content' => 'required|max:1000',
                'price' => 'required',
                'year_published' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if ($request->file('cover')) {
                $image = $request->file('cover');
                $coverName = time() . '.' . $image->getClientOriginalExtension();
            }

            $book = new Book();
            $book->title = $request->get('title');
            $book->content = $request->get('content');
            $book->price = $request->get('price');
            $book->year_published = $request->get('year_published');
            $book->author_id = rand(1, 10);
            $book->cover = $coverName;

            if ($book->save()) {
                $this->uploadImage($image, $book->id, $coverName);
            }

            return redirect()->back()->with('success', 'Book added successfully');

        }
        catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'something went wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  $image
     * @param  $id
     * @param  $name
     * @return void
     */
    public function uploadImage($image, $id, $name)
    {
        $destinationPath = public_path('/assets/books/' . $id . '/');

        // If directory is not there create it.

        if (!is_dir($destinationPath)) {
            mkdir("$destinationPath");
            chmod("$destinationPath", 0755);
        }

        // If directory has images clean first before upload.

        if (!empty(scandir($destinationPath))) {
            File::cleanDirectory($destinationPath);
        }

        $image->move($destinationPath, $name);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('pages.books.single')->with('book', $book);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('pages.books.edit')->with('book', $book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookRequest  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        // return 123;
        //Validate data before updating.

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'cover' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'content' => 'max:1000',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        $book->update([
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'price' => $request->get('price'),
            'year_published' => $request->get('year_published'),
        ]);

        //Image Upload
        if ($request->hasFile('cover')) {
            $image = $request->file('cover');
            $name = time() . '.' . $image->getClientOriginalExtension();

            $this->uploadImage($image, $book->id, $name);

            // Image uploaded then add name in database.

            $book->update([
                'cover' => $name,
            ]);
        }

        return back()->with('success', 'Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        try {
            //code...
            $book->delete();
            return back()->with('success', 'Book deleted successfully');
        } catch (Exception $e) {
            //throw $e;
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'something went wrong');
        }
    }

    // public function singleBookPage($id)
    // {
    //     $book = Book::where('id', $id)->get();
    //     return view('pages.books.single')->with('book', $book);
    // }
}
