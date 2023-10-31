@extends('layouts.frontend.main')
@section('og')
        <!-- Open Graph meta tags -->
        <meta property="og:title" content="{{ $book->name }}">
        <meta property="og:description" content="{{ $book->description }}">
        <meta property="og:image" content="{{  $book->hasMedia('book_image')? $book->getMedia('book_image')[0]->getFullUrl():'' }}">
        <meta property="og:url" content="{{  route('frontend.bookDetails',$book->id) }}">
        <meta property="og:type" content="book">
    
@endsection
@section('twi')
        <!-- Twitter Card meta tags -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $book->name }}">
        <meta name="twitter:description" content="{{ $book->description }}">
        <meta name="twitter:image" content="{{  $book->hasMedia('book_image')? $book->getMedia('book_image')[0]->getFullUrl():''  }}">
        <meta name="twitter:url" content="{{ route('frontend.bookDetails',$book->id) }}">
    
@endsection
@section('pin')
        <!-- Pinterest meta tags -->
        <meta name="p:domain_verify" content="your-pinterest-verification-code" />
        <meta name="pinterest-rich-pin" content="true" />
    
@endsection
@section('content')

<div class="container-fluid mt-3">
    <div class="row justify-content-evenly mt-4">
        <div class="col-md-8 bg-dark text-white text-center">
             Books Details of {{$book->name}}
        </div>
    </div>
    {{-- <div class="row justify-content-evenly"> --}}
        {{-- <div class="card mb-8"> --}}
            <div class="row justify-content-evenly p-5">
              <div class="col-md-4 ">
                <img src="{{ $book->hasMedia('book_image')? $book->getMedia('book_image')[0]->getFullUrl():'' }}" class="img-fluid rounded-start" width="400px" height="550px">
              </div>
              <div class="col-md-6">
                <div class="card-body">
                  <h5 class="card-title">Book name : {{$book->name}}</h5>
                  <p class="card-text">Full Description : {{$book->description}}</p>
                  <p class="card-text">Category : <strong>{{$book->category->name}}</strong></p>
                  <p class="card-text"> <label for="">Author By:</label><strong>{{$book->author->name}}</strong></p>
                  <p class="card-text">Price :{{$book->price}}</p>
                  <p class="card-text">Quantity :{{$book->quantity}}</p>
                  <p class="card-text"><small class="text-muted">Book Created at  {{$book->created_at}}</small></p>
                    <a href="{{route('frontend.readMore',$book->id)}}" class="btn btn-primary">Click for Read</a>
                </div>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('frontend.bookDetails',$book->id) }}" target="_blank">Share on Facebook</a>
                <a href="https://twitter.com/intent/tweet?url={{  route('frontend.bookDetails',$book->id) }}&text={{ urlencode($book->name) }}" target="_blank">Share on Twitter</a>

                <a href="https://plus.google.com/share?url={{  route('frontend.bookDetails',$book->id) }}" target="_blank">Share on Google Plus</a>
            
                {{-- <a data-pin-do="buttonPin" data-pin-url="{{  route('frontend.bookDetails',$book->id) }}" href="https://www.pinterest.com/pin/create/button/" target="_blank">Pin it on Pinterest</a> --}}
                <a href="https://www.pinterest.com/pin/create/button/"
                data-pin-do="buttonBookmark"
                data-pin-custom="true"
                data-pin-description="{{ $book->description }}"
                data-pin-media="{{  $book->hasMedia('book_image')? $book->getMedia('book_image')[0]->getFullUrl():''  }}"
                data-pin-url="{{ route('frontend.bookDetails',$book->id) }}">
                Pin It
            </a>
            <script async defer src="https://assets.pinterest.com/js/pinit.js"></script>
              </div>
            {{-- </div> --}}
          </div>

    </div>
        </div>
        @endsection