@extends('layouts.mylayout')

@section('content')

    <h1>allbooks</h1>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <form>
                        <div class="form-group">
                            <label for="exampleInputBook">Book name</label>
                            
                            <div class="dropdown show">
                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownBook" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Select book name
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownBook">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputAuthor">Author</label>

                            <div class="dropdown show">
                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownAuthor" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Select author name
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownAuthor">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                </div>

                <div class="col-md-9">
                    <div class="row">
                        @if($books)
                            @foreach($books as $item)
                                <div class="col-md-3">
                                    <div class="card mb-4 box-shadow">
                                        <img class="card-img-top" src="{{asset('/thumbnail.png')}}" alt="Card image cap">
                                        <div class="card-body">
                                            <h4>{{$item->name}}</h4>
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
    {{$books->links()}}
    </div>

@endsection