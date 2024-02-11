@extends('adminlte::page')

@section('title', 'Products List')

@section('content_header')
    <h1>Products List</h1>
@stop

@section('content')
<div class="">
    <form class="form-group search-container" action="{{ url('items/search') }}" method="get">
    @csrf
        <div>
            <input class="form-control" type="text" name="keyword" placeholder="Enter the keywords" value="">
        </div>
        <div class="search-button">
            <button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i>Search</button>
        </div>
        
    </form>
</div>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Products List</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <a href="{{ url('items/add') }}" class="btn btn-default">Product Registration</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>EAN Code</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Notes</th>
                                <th>Price</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->jan_code }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->type }}</td>
                                    <td>{{ $item->detail }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td class="pe-0"><a href="/items/edit/{{ $item->id }}">
                                        <button class="btn btn-secondary">Edit</button>
                                    </a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
<link rel="stylesheet" href="{{ asset('/css/app.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
@stop

@section('js')
@stop
