@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">

        <div class="panel panel-default">
            <div class="panel-heading">Search</div>
            <div class="panel-body">
                <form class="form-inline" action="{{ route('adm.users.index') }}">
                    <input type="hidden" name="page" value="1" />
                    <div class="form-group form-group-sm">
                        <select name="search_type" class="form-control">
                            <option value="">선택해주세요.</option>
                            <option value="email" {{ ($params['search_type'] == "email") ? 'selected': '' }}>이메일</option>
                            <option value="name" {{ ($params['search_type'] == "name") ? 'selected': '' }}>이름</option>
                        </select>
                    </div>
                    <div class="form-group form-group-sm">
                        <input type="text" name="search_value" class="form-control" value="{{ $params['search_value'] }}" />
                    </div>
                    <input type="submit" class="btn btn-default btn-sm" value="검색" />
                </form>
            </div>
            <div class="panel-body">
                <div>
                    <a href="{{ route('adm.banners.create') }}" class="btn btn-default btn-sm">등록</a>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">User List</div>
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
                <div>
                {{ $users->appends(['search_type' => $params['search_type'], 'search_value' => $params['search_value']])->links() }}
                </div>
            </div>
        </div>


    </div>
</div>
@endsection
