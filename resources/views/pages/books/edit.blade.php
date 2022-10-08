@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success m-3" role="alert">
                            {{ session('success') }}
                        </div>
                    @else
                        @if(session('error'))
                            <div class="alert alert-danger m-3">
                                {{ session('error') }}
                            </div>

                        @endif   
                    @endif


                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(isset($book))
                        <form method="POST" enctype="multipart/form-data" action="{{ route('books.update', ['book' => $book->id]) }}">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="form-group">
                                <label for="cover">Cover</label>
                                <input type="file" name="cover" class="form-control" id="bookCover" >
                            </div>
                            <div class="form-group">
                            <label for="bookTitle">Book Title</label>
                            <input type="text" name="title" class="form-control" id="bookTitle" aria-describedby="emailHelp"
                            placeholder="Enter Book Title" value="{{ $book->title }}">
                            </div>
                            <div class="form-group">
                                <label for="content">Details</label>
                                <textarea class="form-control text-left" name="content" id="content" cols="30" rows="10">
                                    {{ $book->content }}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="bookPrice">Price</label>
                                <input type="text"  value="{{ $book->price }}" class="form-control" name="price" id="bookPrice" aria-describedby="emailHelp"
                                placeholder="Enter price" >
                            </div>

                            <div class="form-group">
                                <label for="yearPublished">Year Published</label>
                                <input type="text"  value="{{ $book->year_published }}" class="form-control" name="year_published" id="yearPublished"
                                placeholder="Enter Year Published" >
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a class="btn btn-primary" href="{{ url()->previous() }}">Back</a>
                        </form>
                    @endif

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
