@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-xs-12">

            <div class="card">
                @if($board->thumbnail)
                <img src="{{ asset($board->thumbnail->path) }}" class="card-img-top" />
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $board->title }}</h5>
                    <p class="card-text">{!! nl2br($board->body) !!}</p>
                </div>
                <div class="card-body custom-box">
                    <div class="float-left">
                        <a href="{{ route('boards.index') }}" class="card-link">List</a>
                        @if(Auth::id() == $board->user_id)
                        <a href="{{ route('boards.edit', ['id' => $board->id])}}" class="card-link">Modify</a>
                        <a href="javascript:void(0);" class="card-link text-danger" onclick="$('#frm-delete').submit();">Delete</a>
                        <form id="frm-delete" action="{{ route('boards.destroy', ['id' => $board->id]) }}" method="post">
                            @csrf
                            @method('delete')
                        </form>
                        @endif
                    </div>
                </div>
                <div class="card-body custom-box">
                    <form method="post" action="{{ route('boards.comments', ['id' => $board->id]) }}">
                        @csrf
                        <div class="input-group">
                            <textarea name="body" class="form-control" aria-label="With textarea"></textarea>
                            <div class="input-group-append">
                                <input type="submit" class="btn btn-outline-secondary" value="작성" />
                            </div>
                        </div>
                    </form>
                </div>
                @if(count($board->comments) > 0)
                <div class="card-body custom-box">
                    <ul class="list-group list-group-flush">
                        @foreach($board->comments as $comment)
                        <li class="list-group-item">{!! nl2br($comment->body) !!}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

            </div>

        </div>
    </div>
</div>
@endsection
