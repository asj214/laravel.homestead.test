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

				<form id="frm-survey" class="form-horizontal row-border" method="POST" action="{{ $route }}" enctype="multipart/form-data">
                    @csrf
					<div class="form-group form-group-sm">
						<label class="col-md-2 control-label">이벤트명</label>
						<div class="col-md-10">
							<input type="text" name="name" class="form-control" />
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label class="col-md-2 control-label">소개</label>
						<div class="col-md-10">
							<input type="text" name="intro" class="form-control" value="{{ $banner->intro ?? '' }}" />
						</div>
					</div>

                    <div class="form-group form-group-sm">
						<label class="col-md-2 control-label">이벤트 기간 사용 유무</label>
						<div class="col-md-10">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="period_yn" value="Y" {{ $period_yn == 'Y' ? 'checked': '' }} />사용
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="period_yn" value="N" {{ $period_yn == 'N' ? 'checked': '' }} />사용안함
                                </label>
                            </div>
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label class="col-md-2 control-label">이벤트 기간 설정</label>
						<div class="col-md-10">
							<div class="row">
								<div class="col-xs-6">
									<input type="text" name="started_at" class="form-control datepicker" placeholder="시작일">
								</div>
								<div class="col-xs-6">
									<input type="text" name="finished_at" class="form-control datepicker" placeholder="종료일">
								</div>
							</div>
						</div>
					</div>

                    <div class="form-group form-group-sm">
                        <label class="col-md-2 control-label" form="descr">관련 소개 글</label>
                        <div class="col-md-10">
                            <textarea name="descr" id="descr"></textarea>
                        </div>
					</div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 control-label" form="policy">개인정보약관</label>
                        <div class="col-md-10">
                            <textarea name="policy" id="policy"></textarea>
                        </div>
					</div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 control-label" form="marketing_terms">마케팅정보활용약관</label>
                        <div class="col-md-10">
                            <textarea name="marketing_terms" id="marketing_terms"></textarea>
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
$(document).ready(function(){
    tinymce.init({
        selector: 'textarea#descr, textarea#marketing_terms, textarea#policy',
        height: 300,
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount'
        ],
        toolbar: 'undo redo | formatselect | ' +
            ' bold italic backcolor | alignleft aligncenter ' +
            ' alignright alignjustify | bullist numlist outdent indent |' +
            ' removeformat | help',
        content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tiny.cloud/css/codepen.min.css'
        ]
    });
});
</script>
@endsection
