@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">내 정보 수정</h5>
                    <form method="post" action="{{ route('users.update', ['id' => $user->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" name="email" class="form-control-plaintext" disabled id="email" value="{{ $user->email }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nickname" class="col-sm-2 col-form-label">NickName</label>
                            <div class="col-sm-10">
                                <input type="text" name="nickname" class="form-control" id="nickname" value="{{ $user->nickname }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="avatar" class="col-sm-2 col-form-label">Avatar</label>
                            <div class="col-sm-10">
                                <input type="file" name="avatar" class="form-control" id="avatar" />
                            </div>
                        </div>
                        <a href="{{ route('users.show', ['id' => $user->id]) }}" class="btn btn-light">마이페이지</a>
                        <input type="submit" class="btn btn-primary" value="저장" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
