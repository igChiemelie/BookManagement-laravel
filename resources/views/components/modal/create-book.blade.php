<div>
    <div class="modal fade" id="addNewBookModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Book</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" action="{{ route('books.store') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="cover">Cover</label>
                        <input type="file" name="cover" class="form-control" id="bookCover" >
                    </div>
                    <div class="form-group">
                    <label for="bookTitle">Book Title</label>
                    <input type="text" name="title" class="form-control" id="bookTitle" aria-describedby="emailHelp"
                    placeholder="Enter Book Title">
                    </div>
                    <div class="form-group">
                        <label for="content">Details</label>
                        <textarea class="form-control text-left" name="content" id="content" cols="30" rows="10">
                           
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="bookPrice">Price</label>
                        <input type="text" class="form-control" name="price" id="bookPrice" aria-describedby="emailHelp"
                        placeholder="Enter price" >
                    </div>

                    <div class="form-group">
                        <label for="yearPublished">Year Published</label>
                        <input type="text" class="form-control" name="year_published" id="yearPublished"
                        placeholder="Enter Year Published" >
                    </div>
                    <hr>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
</div>