@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-xs-12">

            <div class="card">
                @isset($board->attachments)
                <div class="carousel">
                    @foreach($board->attachments as $attachment)
                    <img src="{{ asset($attachment->path) }}" class="card-img-top" />
                    @endforeach
                </div>
                
                @endisset
                <div class="card-body">
                    <h5 class="card-title">{{ $board->title }}</h5>
                    <p class="card-text">{!! nl2br($board->body) !!}</p>
                </div>
                <div class="card-body">
                    <div class="float-left">
                        <a href="{{ route('gallerys.index') }}" class="card-link">List</a>
                        @if(Auth::id() == $board->user_id)
                        <a href="{{ route('gallerys.edit', ['id' => $board->id])}}" class="card-link">Modify</a>
                        <a href="javascript:void(0);" class="card-link text-danger" onclick="$('#frm-delete').submit();">Delete</a>
                        <form id="frm-delete" action="{{ route('gallerys.destroy', ['id' => $board->id]) }}" method="post">
                            @csrf
                            @method('delete')
                        </form>
                        @endif
                    </div>
                    <div class="float-right">
                        <a href="javascript:void(0);"><i class="far fa-comment-dots"></i>&nbsp;{{ $board->comment_cnt }}</a>
                        <form id="board_like" style="display: inline" method="POST" action="{{ ($current_user_like == 1) ? route('boards.unlike', $board->id): route('boards.like', $board->id) }}">
                            @csrf
                            @if($current_user_like == 1)
                            @method('delete')
                            @endif
                            <a href="javascript:void(0);" onclick="$('#board_like').submit();">
                                <i class="{{ ($current_user_like == 1) ? 'fas': 'far' }} fa-heart"></i>&nbsp;{{ $board->like_cnt }}
                            </a>
                        </form>
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
                                <img src="{{ $comment->user->avatar }}" class="mr-3 rounded-circle" style="width: 64px" />
                                @else
                                <img src="https://via.placeholder.com/64" class="mr-3 rounded-circle" />
                                @endif
                            </a>
                            <div class="media-body">
                                <div>
                                    <div class="float-left">
                                        <a href="{{ route('users.show', ['id' => $comment->user_id]) }}"><b>{{ $comment->user->name }}</b></a>
                                        &nbsp;
                                        <span class="text-monospace">{{ $comment->created_at->format('Y.m.d') }}</span>
                                    </div>
                                    @if($comment->user_id == Auth::id())
                                    <div class="float-right">
                                        <form method="POST" action="{{ route('boards.remove_comments', ['id' => $comment->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" class="btn btn-link" value="삭제" />
                                        </form>
                                    </div>
                                    @endif
                                </div>
                                <br />
                                <p>{!! nl2br($comment->body) !!}</p>
                                <div class="media-body">
                                    <div class="float-right">
                                        <form method="post" action="{{ (in_array($comment->id, $comment_likes)) ? route('comments.unlike', $comment->id): route('comments.like', $comment->id) }}">
                                            @csrf
                                            @if(in_array($comment->id, $comment_likes))
                                            @method('delete')
                                            @endif
                                            <button type="submit" class="btn btn-link">
                                                <i class="{{ (in_array($comment->id, $comment_likes)) ? 'fas':'far' }} fa-heart"></i>&nbsp;{{ $comment->like_cnt }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
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
<script type="text/javascript">
$(document).ready(function(){

    $('.carousel').bxSlider({
		mode: 'horizontal',
		speed: 400,
		captions: false,
		controls: false,
		auto: true,
		autoControls: false,
		stopAutoOnClick: true,
		autoDelay: 0,
		pager: false,
		infiniteLoop: true
	});
    
});
</script>
@endsection
