@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">

        <div class="panel panel-default">
            <div class="panel-heading">Search</div>
            <div class="panel-body">
                <div>
                    <a href="{{ route('adm.banners.create') }}" class="btn btn-default">등록</a>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Toilet List</div>
            <div class="panel-body">
                <table class="table table-striped table-condensed">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>배너</th>
                            <th>배너명</th>
                            <th>등록자</th>
                            <th>노출 시작일</th>
                            <th>노출 종료일</th>
                            <th>노출 Y/N</th>
                            <th>등록일</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($banners as $banner)
                        <tr>
                            <td>{{ $banner->id }}</td>
                            <td>
                                @if($banner->attachment->path)
                                <a href="{{ route('adm.banners.edit', ['id' => $banner->id]) }}">
                                    <img src="{{ asset($banner->attachment->path) }}" style="width: 150px;" />
                                </a>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('adm.banners.edit', ['id' => $banner->id]) }}">{{ $banner->title }}</a>
                            </td>
                            <td>{{ $banner->user->name }}</td>
                            <td>{{ $banner->started_at }}</td>
                            <td>{{ $banner->finished_at }}</td>
                            <td>{{ $banner->display_yn }}</td>
                            <td>{{ $banner->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    </div>
</div>
@endsection
