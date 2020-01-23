@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-xs-12">

            <div class="card">

                <div class="card-header">{{ $user->name }}님의 작성 게시글</div>
                <div class="list-group list-group-flush">
                    @foreach($boards as $board)
                    <a href="{{ route('boards.show', ['id' => $board->id]) }}" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{ $board->title }}</h5>
                            <small>{{ $board->created_at->format('Y.m.d') }}</small>
                        </div>
                        <p class="mb-1">{{ $board->body }}</p>
                        <small>조회수: {{ $board->view_cnt }}</small>
                        <small>댓글수: {{ $board->comment_cnt }}</small>
                    </a>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
