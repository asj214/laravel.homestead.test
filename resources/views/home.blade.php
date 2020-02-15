@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(count($banners) > 0)
        <div class="col-md-6">
            <div class="card main-top-slider">
                @foreach($banners as $banner)
                    @isset($banner->attachment->path)
                    <a href="{{ $banner->link_url ?? 'javascript:void(0);' }}">
                        <img src="{{ asset($banner->attachment->path) }}" class="card-img-top" />
                    </a>
                    @endisset
                @endforeach
                
            </div>
        </div>
        @endif

    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){

    alert('ts');

});
</script>
@endsection
