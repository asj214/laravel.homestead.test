@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(count($banners) > 0)
        <div class="col-md-8 mb-3">
            <div class="card">
                <div class="main-top-slider">
                @foreach($banners as $banner)
                    @isset($banner->attachment->path)
                    <a href="{{ $banner->link_url ?? 'javascript:void(0);' }}">
                        <img src="{{ asset($banner->attachment->path) }}" class="card-img-top" />
                        <!-- <img src="https://via.placeholder.com/600x200" class="card-img-top" /> -->
                    </a>
                    @endisset
                @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>

    @if(count($surveys) > 0)
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div id="surveys">
                @foreach($surveys as $survey)
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $survey->name }}</h5>
                        @if($survey->period_yn == 'Y')
                        <h6 class="card-subtitle mb-2 text-muted">[{!! date('Y.m.d', strtotime($survey->started_at)) !!} ~ {!! date('Y.m.d', strtotime($survey->finished_at)) !!}]</h6>
                        @endif
                        <p class="card-text">{{ $survey->intro }}</p>
                        <a href="{{ route('surveys.show', ['event_id' => $survey->id]) }}" class="btn btn-primary">자세히</a>
                        <a href="{{ route('surveys.create', ['event_id' => $survey->id]) }}" class="btn btn-success">지원하기</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">카드 타이틀</h5>
                            <p class="card-text">텍스트</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">카드 타이틀</h5>
                            <p class="card-text">텍스트</p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){

    $('.main-top-slider').bxSlider({
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

    $('#surveys').bxSlider({
		mode: 'horizontal',
		speed: 400,
		captions: false,
		controls: false,
		auto: true,
		autoControls: false,
		stopAutoOnClick: true,
		autoDelay: 0,
		pager: false,
		infiniteLoop: true,
        touchEnabled: false
	});

    

});
</script>
@endsection
