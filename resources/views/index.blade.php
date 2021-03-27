@extends('layouts.mylayout')

@section('content')

    <h1>allbooks</h1>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <form method="post" action="{{route('index')}}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputBook">Book name</label>
                            <select class="custom-select" name="bookId">
                                <option selected value="">Select book name</option>
                                @foreach($booksFilter as $itemBook)
                                    <option value="{{$itemBook->id}}">{{$itemBook->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputAuthor">Author</label>
                            <select class="custom-select" name="authorId">
                                <option selected value="">Select author name</option>
                                @foreach($authors as $itemAuthor)
                                    <option value="{{$itemAuthor->id}}">{{$itemAuthor->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                </div>

                <div class="col-lg-9">
                    <div class="row">
                        @if($booksPaginated)
                            @foreach($booksPaginated as $item)
                                <div class="col-lg-3">
                                    <div class="card mb-4 box-shadow">
                                        <img class="card-img-top" src="{{asset('/thumbnail.png')}}" alt="Card image cap">
                                        <div class="card-body">
                                            <h4>{{$item->name}} ({{$item->authors->name}})</h4>
                                            <p class="card-text">{{$item->description}}</p>

                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary">В корзину</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h1>No products</h1>
                        @endif
                    </div>
                </div>




            </div>
        </div>
    {{$booksPaginated->links()}}
    </div>

@endsection