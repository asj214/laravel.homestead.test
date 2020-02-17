@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(count($banners) > 0)
        <div class="col-md-8">
            <div class="card">
                <div class="main-top-slider">
                @foreach($banners as $banner)
                    @isset($banner->attachment->path)
                    <a href="{{ $banner->link_url ?? 'javascript:void(0);' }}">
                        <img src="{{ asset($banner->attachment->path) }}" class="card-img-top" />
                    </a>
                    @endisset
                @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>
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

});
</script>
@endsection
