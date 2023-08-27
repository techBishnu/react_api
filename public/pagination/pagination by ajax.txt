@extends('layouts.frontend.main')
@section('content')
<div class="container-fluid mt-3">
    <div class="row justify-content-evenly mt-4">
        <div class="col-md-8 bg-dark text-white text-center">
            All Books
        </div>
    </div>
    <div class="row  " id="bookList">

        @foreach ($books as $book)
            
     
            <div class="card col-md-3 mx-2 my-4">
                <a href="{{route('frontend.bookDetails',$book->id)}}">
              <img src="{{ $book->hasMedia('book_image')? $book->getMedia('book_image')[0]->getFullUrl():'' }}" class="img-fluid"  alt="...">
            </a>
              <div class="card-body">
                <h5 class="card-title">{{$book->name}}</h5>
                <p class="card-text">Category : <strong>{{$book->category->name}}</strong></p>
                <p class="card-text"> <label for="">Author By:</label><strong>{{$book->author->name}}</strong></p>
                <p class="card-text">Price :{{$book->price}}</p>
              
            </div>
            </div>
            @endforeach
        {{-- </div> --}}
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <ul class="pagination" id="pagination">
                <!-- Pagination links will be added here -->
            </ul>
        </div>
    </div>
    </div>


    <script>
        $(document).ready(function () {
            const itemsPerPage = 3;
            const booksData = {!! json_encode($books) !!}; // The array of book data
            console.log(booksData);
            debugger
            let currentPage = 1;
            displayBooks(currentPage);
    
            function displayBooks(page) {
                $('#bookList').empty();
                const startIndex = (page - 1) * itemsPerPage;
                const endIndex = startIndex + itemsPerPage;
    
                for (let i = startIndex; i < endIndex && i < booksData.length; i++) {
    const book = booksData[i];
    // Generate the URL for the first image in the 'book_image' collection
    const imageUrl = book.media[0] ? book.media[0].original_url : ''; // Change 'book_image' if needed
      
     // Generate the URL for the book details page
     const bookDetailsUrl = "{{ route('frontend.bookDetails', ':bookId') }}".replace(':bookId', book.id);   
    // Create and append the book card using book data
    const bookCard = `
        <div class="card col-md-3 mx-2 my-4">
            <a href="${bookDetailsUrl}">
                <img src="${imageUrl}" class="img-fluid" alt="...">
            </a>
            <div class="card-body">
                <h5 class="card-title">${book.name}</h5>
                <p class="card-text">Category : <strong>${book.category.name}</strong></p>
                <p class="card-text">Author : <strong>${book.author.name}</strong></p>
                <p class="card-text">Price : ${book.price}</p>
            </div>
        </div>
    `;
    $('#bookList').append(bookCard);
}

    
                updatePagination(Math.ceil(booksData.length / itemsPerPage), page);
            }
    
            $(document).on('click', '.pagination-link', function (e) {
                e.preventDefault();
                const page = parseInt($(this).data('page'));
                displayBooks(page);
            });
    
            function updatePagination(totalPages, currentPage) {
                $('#pagination').empty();
                for (let i = 1; i <= totalPages; i++) {
                    const activeClass = i === currentPage ? 'active' : '';
                    $('#pagination').append(`<li class="page-item ${activeClass}">
                        <a class="page-link pagination-link" href="#" data-page="${i}">${i}</a>
                    </li>`);
                }
            }
        });
    </script>
    
@endsection