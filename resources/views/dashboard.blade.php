<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @section('content')
                    @role('superadmin')
                    <div class="row" style="padding: 10px">
                        <div class="col-md-12">
                            <h4>All Sales</h4>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">Order number</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Created</th>
                                    <th scope="col">Books</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($allOrders as $item)
                                    <tr>
                                        <th scope="row">{{$item->id}}</th>
                                        <td>{{$item->users->name}}</td>
                                        <td>{{$item->total}}</td>
                                        <td>{{$item->created_at}}</td>
                                        <td>
                                            @foreach(json_decode($item->books) as $item)
                                                {{$item->name}}
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @else
                        <div class="row" style="padding: 10px">
                            <div class="col-md-12">
                                <h4>My Shopping</h4>
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">Order number</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Created</th>
                                        <th scope="col">Books</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $item)
                                        <tr>
                                            <th scope="row">{{$item->id}}</th>
                                            <td>{{$item->total}}</td>
                                            <td>{{$item->created_at}}</td>
                                            <td>
                                                @foreach(json_decode($item->books) as $item)
                                                    {{$item->name}}
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        @endrole

                @endsection
            </div>
        </div>
    </div>





</x-app-layout>
