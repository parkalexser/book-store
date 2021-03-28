@extends('layouts.mylayout')

@section('content')
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Your cart</span>
                        <span class="badge badge-secondary badge-pill">{{\Cart::session(auth()->user()->id)->getContent()->count()}}</span>
                    </h4>
                    <ul class="list-group mb-3">
                        @foreach($cartItems as $item)
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">{{$item['name']}}</h6>
                                    <small class="text-muted">{{$item['attributes']['description']}}</small>
                                </div>
                                <span class="text-muted">${{$item['price']}}</span>
                            </li>
                        @endforeach
                    </ul>

                    {{--<form class="card p-2">--}}
                        {{--<div class="input-group">--}}
                            {{--<input type="text" class="form-control" placeholder="Promo code">--}}
                            {{--<div class="input-group-append">--}}
                                {{--<button type="submit" class="btn btn-secondary">Redeem</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                </div>
                <div class="col-md-8 order-md-1">
                    <h4 class="mb-3">Checkout</h4>
                    <form class="needs-validation" novalidate="">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="firstName">Name</label>
                                <input type="text" class="form-control" id="firstName" placeholder="" value="" required="">
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="email">Email <span class="text-muted">(Optional)</span></label>
                                <input type="email" class="form-control" id="email" placeholder="you@example.com">
                                <div class="invalid-feedback">
                                    Please enter a valid email address for shipping updates.
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection