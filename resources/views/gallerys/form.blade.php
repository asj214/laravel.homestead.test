@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-xs-12">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form method="post" action="{{ route('gallerys.store') }}" enctype="multipart/form-data">
                @csrf
                @isset($board->id)
                @method('patch')
                @endisset
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="press input">
                </div>
                <div class="form-group">
                    <label for="body">Body</label>
                    <textarea class="form-control" name="body" id="body"></textarea>
                </div>
                <div class="form-group">
                    <label for="attachments">attachments</label>
                    <input type="file" class="form-control" name="attachments" id="attachments" />
                </div>
                <button type="submit" class="btn btn-primary">Sign in</button>
                <a href="{{ route('gallerys.index') }}" class="btn btn-outline-primary">List</a>
            </form>

        </div>
    </div>
</div>
@endsection
