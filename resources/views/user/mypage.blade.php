@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-xs-12">

            <div class="card">

                <div class="card-body">
                    <div class="media">
                        @if(!empty($user->avatar))
                        <img src="{{ $user->avatar }}" class="mr-3 rounded-circle" />
                        @else
                        <img src="https://via.placeholder.com/75/FFFF00/000000?Text=75x75" class="mr-3 rounded-circle" />
                        @endif
                        <div class="media-body">
                            <h5 class="mt-4">{{ $user->name }}</h5>
                        </div>
                    </div>
                </div>

                <div class="list-group list-group-flush">
                    <a href="#" class="list-group-item d-flex justify-content-between align-items-center">
                        작성한 게시글
                        <span class="badge badge-primary badge-pill">{{ $user->boards_count }}</span>
                    </a>
                    <a href="#" class="list-group-item d-flex justify-content-between align-items-center">
                        작성한 댓글
                        <span class="badge badge-primary badge-pill">{{ $user->comments_count }}</span>
                    </a>
                </div>


                <div class="card-body">
                    asd
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
