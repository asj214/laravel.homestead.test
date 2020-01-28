@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">

        <form action="{{ route('adm.banners.store') }}" enctype="multipart/form-data">

            <div class="panel panel-default">
                <div class="panel-heading">등록 양식</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="title">제목</title>
                        <input type="text" name="title" id="title" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="intro">소개</title>
                        <input type="text" name="intro" id="intro" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="descr">추가글</title>
                        <input type="text" name="descr" id="descr" class="form-control" />
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="validatedCustomFile" required>
                        <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                        <div class="invalid-feedback">Example invalid custom file feedback</div>
                    </div>
                </div>
            </div>

        </form>

    </div>
</div>
@endsection
