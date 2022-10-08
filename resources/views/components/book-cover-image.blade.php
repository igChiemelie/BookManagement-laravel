<div>
    <!-- He who is contented is rich. - Laozi -->
    @if(Str::contains($book->cover,'https'))
        <img src="{{$book->cover}}" alt="{{$book->title}}" width="50px" height="50px">
    @else
        <img src="/assets/books/{{$book->id}}/{{$book->cover}}" alt="{{$book->title}}" width="50px" height="50px">
    @endif
</div>