@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-xs-12">
            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('gallerys.update', ['id' => $board->id]) }}" enctype="multipart/form-data" class="mb-2">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="press input" value="{{ old('title') ?? $board->title }}">
                        </div>
                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea class="form-control" name="body" id="body">{{ old('body') ?? $board->body }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="attachments">attachments</label>
                            <input type="file" class="form-control" name="attachments[]" id="attachments" multiple />
                        </div>
                        <button type="submit" class="btn btn-primary">Sign in</button>
                        <a href="{{ route('gallerys.index') }}" class="btn btn-outline-primary">List</a>
                    </form>
                </div>
                <hr>
                <div class="card-body">

                    @isset($board->attachments)
                    <div class="row row-cols-1 row-cols-md-3">
                        @foreach($board->attachments as $attachment)
                        <div class="col mb-4">
                            <div class="card h-100">
                                <img src="{{ asset($attachment->path) }}" class="card-img-top h-75" />
                                <div class="card-body">
                                    <form method="post" action={{ route('attachments.destroy', ['id' => $attachment->id]) }}>
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name="redirect_url" value="{{ route('gallerys.edit', ['id' => $board->id]) }}" />
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endisset
                </div>

            </div>

        </div>
    </div>
</div>

@endsection
