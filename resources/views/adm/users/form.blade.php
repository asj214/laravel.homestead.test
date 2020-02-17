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
			<div class="panel-heading clearfix"># 회원 정보</div>
			<div class="panel-body">

				<form id="frm-user" class="form-horizontal row-border" method="POST" action="{{ route('adm.users.update', ['id' => $user->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group form-group-sm">
						<label class="col-md-2 control-label">이메일</label>
						<div class="col-md-10">
							<input type="text" name="email" class="form-control" value="{{ $user->email ?? '' }}" readonly />
						</div>
					</div>
                    <div class="form-group form-group-sm">
						<label class="col-md-2 control-label">이름</label>
						<div class="col-md-10">
							<input type="text" name="name" class="form-control" value="{{ $user->name ?? '' }}" readonly />
						</div>
					</div>
                    <div class="form-group form-group-sm">
						<label class="col-md-2 control-label">비밀번호</label>
						<div class="col-md-10">
							<input type="text" name="password" class="form-control" />
						</div>
					</div>
                    <div class="form-group form-group-sm">
						<label class="col-md-2 control-label">등급</label>
						<div class="col-md-10">
							<input type="tel" name="level" class="form-control" value="{{ $user->level ?? '' }}" pattern="[0-9]{1,}" required />
						</div>
					</div>
                    <div class="form-group form-group-sm">
						<label class="col-md-2 control-label">프로필 사진</label>
						<div class="col-md-10">
                            <div>
			                    <input type="file" name="avatar" class="form-control" />
                            </div>
                            @isset($user->avatar->path)
                            <div style="margin-top: 5px;">
                                <img src="{{ asset($user->avatar->path) }}" style="max-width: 300px;" />
                            </div>
                            @endisset
						</div>
					</div>
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

        <div class="panel panel-default">
			<div class="panel-heading clearfix"># 유저가 작성한 게시글</div>
            <div class="panel-body">
                <div id="user_boards"></div>
            </div>

        </div>


    </div>

</div>
<script type="text/javascript">
function current_user_boards(page){
    $.ajax({
        url: '{{ route("adm.users.boards", ["id" => $user->id]) }}',
        type: 'GET', // GET, POST
        dataType: 'html', // html, text
        data: { _token: "{{ csrf_token() }}", page: page }
    }).done(function(res){

        $('#user_boards').html(res);

    });
}
$(document).ready(function(){
    current_user_boards(1);
});
</script>
@endsection
