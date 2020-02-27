@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-xs-12 mb-3">
            <a href="{{ route('gallerys.create') }}" class="btn btn-outline-primary">Write</a>
        </div>
    </div>
    @foreach($boards as $board)
    <div class="row justify-content-center">
        <div class="col-md-6 col-xs-12">
            <div class="card mb-4">
                <div class="carousel">
                    @isset($board->attachments)
                    @foreach($board->attachments as $attachment)
                    <img src="{{ asset($attachment->path) }}" class="card-img-top" />
                    @endforeach
                    @endisset
                </div>
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
    </div>
    @endforeach
    <div class="row justify-content-center">
        <div class="col-md-6 col-xs-12">
            {{ $boards->links() }}
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
