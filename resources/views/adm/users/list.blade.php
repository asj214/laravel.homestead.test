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
                            <th>이름</th>
                            <th>이메일</th>
                            <th>레벨</th>
                            <th>최근 접속일</th>
                            <th>가입일</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td><a href="{{ route('adm.users.edit', ['id' => $user->id]) }}">{{ $user->name }}</a></td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->level }}</td>
                            <td>{{ $user->last_login_at }}</td>
                            <td>{{ $user->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    </div>
</div>
@endsection
