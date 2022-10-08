@extends('layouts.app')

@section('styles')
    <style>
        td.actions span{
            display: table-cell !important;
        }
        td.actions span .btn{
            margin-right: 5px;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <a href="" class="btn btn-info col-md-2 mr-auto m-3" data-bs-toggle="modal" data-bs-target="#addNewBookModal">
                    <i class="fas fa-plus"></i>Add New Book
                </a>

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

                    <!-- {{ __('You are logged in!') }} -->

                   
                   
                    @if(isset($books))
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Cover</th>
                                <th scope="col">Book Title</th>
                                <th scope="col">Author</th>
                                <th scope="col">Price</th>
                                <th scope="col">Published Year</th>
                                <th scope="col">Last Updated</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                               
                                @if(count($books) > 0)
                                    <h2>{{count($books)}}</h2>
                                    <h3>232</h3>
                                    @foreach($books as $key=>$book)
                                    
                                        <tr>
                                            <td scope="row">{{++$key}}</td>
                                            <td>
                                                @if(Str::contains($book->cover,'https'))
                                                    <img src="{{$book->cover}}" alt="{{$book->title}}" width="100px" height="70px">
                                                @else
                                                    <img src="/assets/books/{{$book->id}}/{{$book->cover}}" alt="{{$book->title}}" width="70px" height="100px">
                                                @endif   
                                            </td>
                                            <td>{{$book->title}}</td>
                                            <td>{{$book->author->name}}</td>
                                            <td>{{$book->price}}</td>
                                            <td>{{$book->year_published}}</td>
                                            <td>{{$book->updated_at}}</td>
                                            <td class="actions">
                                                <span>  
                                                    <a href="{{ URL::to('books/'.$book->id.'/edit')}}" class="btn btn-info">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </span>
                                                <span>  
                                                    <button class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#bookModel{{ $book->id }}">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>

                                                    <!-- Button trigger modal -->
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="bookModel{{ $book->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Delete Book</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to delete this Record ?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <form method="post" action="{{ route('books.destroy', ['book' => $book->id]) }}">
                                                                    {{ csrf_field() }}
                                                                    {{ method_field('DELETE') }}
                                                                    <button type="submit" class="btn btn-primary">Delete</button>
                                                                </form>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <hr>
                        {!! $books->links()!!}
                    @endif
                </div>
            </div>
        </div>
        <!-- Modal -->
            <x-modal.create-book/>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        console.log('ok i see u');
    </script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <!-- Scripts -->
@endsection
