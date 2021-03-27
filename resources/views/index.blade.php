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
                    <hr>
                    <a href="{{route('getCartContent')}}">
                        <button type="button" class="btn btn-warning">
                            Cart <span class="badge badge-light">{{\Cart::session(auth()->user()->id)->getContent()->count()}}</span>
                        </button>
                    </a>

                </div>

                <div class="col-lg-9">
                    <div class="row">
                        @if($booksPaginated)
                            @foreach($booksPaginated as $item)
                                <div class="col-lg-3" id="book-{{$item->id}}">
                                    <div class="card mb-4 box-shadow">
                                        <img class="card-img-top" src="{{asset('/thumbnail.png')}}" alt="Card image cap">
                                        <div class="card-body">
                                            <h4> <span id="name-{{$item->id}}" >{{$item->name}}</span> ({{$item->authors->name}})</h4>
                                            <p class="card-text">{{$item->description}}</p>

                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="btn-group">
                                                    <button id="addcart-{{$item->id}}" onclick="addcart({{$item->id}})" type="button" class="btn btn-sm btn-outline-secondary">В корзину</button>
                                                </div>
                                                <small id="price-{{$item->id}}" class="text-muted">{{$item->price}}</small>
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
    <script type="text/javascript">


        function addcart(id)
        {
            var name = $('#name-'+id).text();
            var price = $('#price-'+id).text();

            $.ajax({
                type:'post',
                url: '<?=route('addCart')?>',
                data:{
                    book_id: id,
                    name: name,
                    price: price
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(response) {
                    $('#addcart-'+id).html("Added").attr('disabled','disabled');;
                }
            });

        }

    </script>

@endsection