@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-xs-12">

            <div class="card">

                <div class="card-header">{{ $user->name }}님의 작성 댓글</div>
                <div class="list-group list-group-flush">
                    @foreach($comments as $comment)
                    <a href="{!! route($comment_type[$comment->commentable_type]['route'], ['id' => $comment->commentable_id]); !!}" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{!! $comment_type[$comment->commentable_type]['type']; !!}</h5>
                            <small class="text-muted">{{ $comment->created_at->format('Y.m.d') }}</small>
                        </div>
                        <p class="mb-1">{!! nl2br($comment->body) !!}</p>
                    </a>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
