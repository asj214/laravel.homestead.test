@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-xs-12">
            <a href="{{ route('boards.create') }}" class="btn btn-outline-primary">Write</a>
        </div>
        @foreach($boards as $board)
        <div class="col-md-8 col-xs-12">
            <div class="card mb-4">
                @if($board->thumbnail)
                <img src="{{ asset($board->thumbnail->path) }}" class="card-img-top" />
                @endif
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="{{ route('boards.show', ['id' => $board->id]) }}">{{ $board->title }}</a>
                    </h5>
                    <p class="card-text">{!! nl2br($board->body) !!}</p>
                </div>
                <div class="card-body custom-box">
                    <a href="javascript:void(0);"><i class="far fa-comment-dots"></i>&nbsp;{{ $board->comment_cnt }}</a>
                    <a href="javascript:void(0);"><i class="{{ (in_array($board->id, $current_user_likes)) ? 'fas': 'far' }} fa-heart"></i>&nbsp;{{ $board->like_cnt }}</a>
                </div>
            </div>
        </div>
        @endforeach
        <div class="col-md-8 col-xs-12">
            {{ $boards->links() }}
        </div>
    </div>
</div>
@endsection
