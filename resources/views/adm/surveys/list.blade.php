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
                            <th>이름</th>
                            <th>이메일</th>
                            <th>레벨</th>
                            <th>최근 접속일</th>
                            <th>가입일</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>
        </div>


    </div>
</div>
@endsection
