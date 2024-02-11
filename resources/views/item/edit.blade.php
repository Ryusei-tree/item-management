@extends('adminlte::page')

@section('title', 'Products Editing')

@section('content_header')
    <h1>Products Editing</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                       @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                       @endforeach
                    </ul>
                </div>
            @endif

            <div class="card card-primary">
                <form action="{{ url('/items/itemEdit', $item->id) }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="jan-code">EAN Code</label>
                            <input type="number" class="form-control" id="jan-code" name="jan_code" value="{{ $item->jan_code }}">
                        </div>
                        <div class="form-group">
                            <label for="name">Product Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}">
                        </div>

                        <div class="form-group">
                            <label for="type">Category</label>
                            <input type="text" class="form-control" id="type" name="type" value="{{ $item->type }}">
                        </div>

                        <div class="form-group">
                            <label for="detail">Notes</label>
                            <input type="text" class="form-control" id="detail" name="detail" value="{{ $item->detail }}">
                        </div>

                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" id="price" name="price" value="{{ $item->price }}">
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
                
                <div class="btn-delete">
                    <button type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-modal">削除</button>
                </div>
                    
                <!-- Confirmation modal for delete -->
                <div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="#delete-modal" aria-hidden=”true”>
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Confirm</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure to delete the selected product?</p>
                                <p>{{ $item->name }}</p>
                            </div>
                            <div class="modal-footer">
                                <div class="modal-footer-btns">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ url('items/delete') }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <button class="btn btn-danger modal-btn-delete" type="submit">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
@stop
