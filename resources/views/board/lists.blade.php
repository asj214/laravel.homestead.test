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
                    <i class="far fa-comment-dots"></i>&nbsp;{{ $board->comment_cnt }}
                </div>
            </div>
        </div>
        @endforeach
        <div class="col-md-8 col-xs-12">
            {{ $boards->links() }}
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){

    $('body').on('click', '.btn-like', function(){

        var board_id = $(this).data('board_id');
        var url = '{{ url("/boards") }}/'+board_id+'/like';
        var method = 'POST';

        $.ajax({
            url: url,
            type: method, // GET, POST
            dataType: 'json', // html, text
            async: false,
            data: { "_token": "{{ csrf_token() }}" }
        }).done(function(r){

            if(r.current_user_like != null){
                $('.btn-board-like').removeClass("off").addClass("on").find(".count_number").text(r.like_count);
            } else {
                $('.btn-board-like').removeClass("on").addClass("off").find(".count_number").text(r.like_count);
            }

        });

        alert(url);

    });



});
</script>
@endsection
