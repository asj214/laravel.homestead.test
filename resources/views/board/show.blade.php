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
                                <button type="button" class="btn btn-outline-secondary">작성</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body custom-box">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                    </ul>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection
