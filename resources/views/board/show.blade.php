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
                <div class="card-body">
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
                <hr />
                <div class="card-body">
                    <form method="post" action="{{ route('boards.comments', ['id' => $board->id]) }}">
                        @csrf
                        <div class="form-group">
                            <label for="body">댓글</label>
                            <textarea name="body" id="body" class="form-control" aria-label="With textarea" required></textarea>
                        </div>
                        <input type="submit" class="btn btn-block btn-light btn-outline-secondary" value="작성" />
                    </form>
                </div>
                @if(count($board->comments) > 0)
                <div class="card-body">
                    <ul class="list-unstyled">
                        @foreach($board->comments as $comment)
                        <li class="media my-4">
                            <a href="{{ route('users.show', ['id' => $comment->user_id]) }}">
                                @if(!empty($comment->user->avatar))
                                <img src="{{ $comment->user->avatar }}" class="mr-3 rounded-circle" />
                                @else
                                <img src="https://via.placeholder.com/64" class="mr-3 rounded-circle" />
                                @endif
                            </a>
                            <div class="media-body">
                                <div>
                                    <div class="float-left">
                                        <a href="{{ route('users.show', ['id' => $comment->user_id]) }}"><b>{{ $comment->user->name }}</b></a>
                                    </div>
                                    <div class="float-right">
                                        <span class="text-monospace">{{ $comment->created_at->format('Y.m.d') }}</span>
                                    </div>
                                </div>
                                <br />
                                <p>{!! nl2br($comment->body) !!}</p>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
