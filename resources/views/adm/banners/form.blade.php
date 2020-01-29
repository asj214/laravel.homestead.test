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

				<form id="frm-banner" class="form-horizontal row-border" method="POST" action="{{ $route }}" enctype="multipart/form-data">
                    @csrf
                    @isset($banner->id)
                    @method('put')
                    @endisset
                    <div class="form-group form-group-sm">
						<label class="col-md-2 control-label">카테고리</label>
						<div class="col-md-10">
							<div class="row">
								<div class="col-xs-6">
									<select name="category_id" class="form-control">
                                        @foreach($categorys as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
								</div>
								<div class="col-xs-6">
                                    <select name="sub_category_id" class="form-control">
                                    </select>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label class="col-md-2 control-label">제목</label>
						<div class="col-md-10">
							<input type="text" name="title" class="form-control" value="{{ $banner->title ?? '' }}" />
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label class="col-md-2 control-label">소개</label>
						<div class="col-md-10">
							<input type="text" name="intro" class="form-control" value="{{ $banner->intro ?? '' }}" />
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label class="col-md-2 control-label">추가글</label>
						<div class="col-md-10">
							<input type="text" name="descr" class="form-control" value="{{ $banner->descr ?? '' }}" />
						</div>
					</div>
                    <div class="form-group form-group-sm">
						<label class="col-md-2 control-label">링크 주소</label>
						<div class="col-md-10">
							<input type="text" name="link_url" class="form-control" value="{{ $banner->link_url ?? '' }}" />
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label class="col-md-2 control-label">노출 기간</label>
						<div class="col-md-10">
							<div class="row">
								<div class="col-xs-6">
									<input type="text" name="started_at" class="form-control datepicker" value="{{ $banner->started_at ?? '' }}" placeholder="시작일">
								</div>
								<div class="col-xs-6">
									<input type="text" name="finished_at" class="form-control datepicker" value="{{ $banner->finished_at ?? '' }}" placeholder="종료일">
								</div>
							</div>
						</div>
					</div>

                    <div class="form-group form-group-sm">
						<label class="col-md-2 control-label">첨부파일</label>
						<div class="col-md-10">
                            <div>
		                        <input type="file" name="attachment" class="form-control" />
                            </div>
                            @isset($banner->attachment)
                            <div style="margin-top: 5px;">
                                <img src="{{ asset($banner->attachment->path) }}" style="max-width: 300px;" />
                            </div>
                            @endisset
						</div>
					</div>

                    <div class="form-group form-group-sm">
						<label class="col-md-2 control-label">노출 설정</label>
						<div class="col-md-10">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="display_yn" value="Y" {{ $display_yn == 'Y' ? 'checked': '' }} />Y
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="display_yn" value="N" {{ $display_yn == 'N' ? 'checked': '' }} />N
                                </label>
                            </div>
						</div>
					</div>
				</form>
			</div>
            <div class="panel-footer">
                <button type="button" class="btn btn-primary" onclick="$('#frm-banner').submit();">등록</button>
                <a href="{{ route('adm.banners.index') }}" class="btn btn-default">목록</a>
                @isset($banner->id)
                <button type="button" class="btn btn-danger" onclick="$('#frm-delete').submit();">삭제</button>
                <form id="frm-delete" action="{{ route('adm.banners.destroy', ['id' => $banner->id]) }}" method="post">
                    @csrf
                    @method('delete')
                </form>
                @endisset
            </div>
		</div>

    </div>

</div>
<script type="text/javascript">
var sub_category_id = {!! $banner->sub_category_id ?? "''" !!};

$(document).ready(function(){

    $('select[name="category_id"]').change(function(){

        $('select[name="sub_category_id"]').html('<option value="">선택해주세요.</option>');

        $.ajax({
            url: "{{ route('adm.banners.categorys') }}",
            type: 'GET',
            data: { category_id: $(this).val() },
            dataType: "json"
		}).done(function(r){

            var len = r.length;
            var selected = '';
            for(var i = 0; i < len; i++){
                selected = (r[i].id == sub_category_id) ? 'selected': '';
                $('select[name="sub_category_id"]').append('<option value="'+r[i].id+'" '+selected+'>'+r[i].name+'</option>');
            }

		});

    });

    $('select[name="category_id"]').trigger('change');

});
</script>
@endsection
