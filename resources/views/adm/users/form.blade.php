@extends('layouts.admin')
@section('content')
<div class="row">

    <div class="col-lg-10">

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="panel panel-default">
			<div class="panel-heading clearfix">Form</div>
			<div class="panel-body">

				<form id="frm-user" class="form-horizontal row-border" method="POST" action="{{ route('adm.users.update', ['id' => $user->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
				</form>
			</div>
            <div class="panel-footer">
                <button type="button" class="btn btn-primary" onclick="$('#frm-user').submit();">등록</button>
                <a href="{{ route('adm.users.index') }}" class="btn btn-default">목록</a>
                <button type="button" class="btn btn-danger" onclick="$('#frm-delete').submit();">삭제</button>
                <form id="frm-delete" action="{{ route('adm.users.destroy', ['id' => $user->id]) }}" method="post">
                    @csrf
                    @method('delete')
                </form>
            </div>
		</div>

    </div>

</div>
@endsection
