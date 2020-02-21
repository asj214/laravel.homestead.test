@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">

        <div class="panel panel-default">
            <div class="panel-heading">Search</div>
            <div class="panel-body">
                <div>
                    <a href="{{ route('adm.surveys.create') }}" class="btn btn-default btn-sm">등록</a>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Survey List</div>
            <div class="panel-body">
                <table class="table table-striped table-condensed">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>이벤트명</th>
                            <th>요약</th>
                            <th>이벤트 기간</th>
                            <th>참여자수</th>
                            <th>수집 항목</th>
                            <th>작성자</th>
                            <th>생성일</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($survey_cfgs as $cfg)
                        <tr>
                            <td>{{ $cfg->id }}</td>
                            <td><a href="{{ route('adm.surveys.edit', ['id' => $cfg->id]) }}">{{ $cfg->name }}</a></td>
                            <td>{{ $cfg->intro }}</td>
                            @if($cfg->period_yn == 'Y')
                            <td>{{ $cfg->started_at }} ~ {{ $cfg->finished_at }}</td>
                            @else
                            <td>상시</td>
                            @endif
                            <td>{{ number_format($cfg->applicant_count) }}</td>
                            <td>{{ $privates[$cfg->id] }}</td>
                            <td>{{ $cfg->user->name }}</td>
                            <td>{{ $cfg->created_at->format('Y.m.d') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                {{ $survey_cfgs->links() }}
                </div>
            </div>
        </div>


    </div>
</div>
@endsection
