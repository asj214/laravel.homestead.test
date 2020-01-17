@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        @foreach($boards as $board)
        <div class="col-md-8 col-xs-12">
            @if($board->thumbnail)
            <div class="card mb-4">
                <img src="{{ asset($board->thumbnail->path) }}" class="card-img-top" />
                <div class="card-body">
                    <h5 class="card-title">{{ $board->title }}</h5>
                    <p class="card-text">{!! nl2br($board->body) !!}</p>
                </div>
                <div class="card-body custom-box">
                </div>
            </div>
            @endif
        </div>
        @endforeach

        <div class="col-md-12 col-xs-12">
            {{ $boards->links() }}
        </div>
    </div>
</div>
<!-- <a href="{{ route('boards.create') }}" class="btn btn-outline-primary">Write</a> -->
@endsection
