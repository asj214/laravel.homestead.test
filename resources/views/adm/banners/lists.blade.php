@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">

        <div class="panel panel-default">
            <div class="panel-heading">Search</div>
            <div class="panel-body">
                <form name="frm_banner_search" class="form-inline" action="{{ route('adm.banners.index') }}">
                    <input type="hidden" name="page" value="1" />
                    <div class="form-group form-group-sm">
                        <select name="category_id" class="form-control">
                            <option value="">선택해주세요.</option>
                            @foreach($categorys as $category)
                            <option value="{{ $category->id }}" {{ ($category->id == $params['category_id']) ? 'selected':'' }}>{{ $category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group form-group-sm">
                        <select name="sub_category_id" class="form-control">
                            <option value="">선택해주세요.</option>
                            @foreach($sub_categorys as $sub_category)
                            <option value="{{ $sub_category->id }}" {{ ($sub_category->id == $params['sub_category_id']) ? 'selected':'' }}>{{ $sub_category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="panel-body">
                <div>
                    <a href="{{ route('adm.banners.create') }}" class="btn btn-default btn-sm">등록</a>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Banner List</div>
            <div class="panel-body">
                <table class="table table-striped table-condensed">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>배너</th>
                            <th>배너명</th>
                            <th>등록자</th>
                            <th>노출 시작일</th>
                            <th>노출 종료일</th>
                            <th>노출 Y/N</th>
                            <th>등록일</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($banners as $banner)
                        <tr>
                            <td>{{ $banner->id }}</td>
                            <td>
                                @isset($banner->attachment->path)
                                <a href="{{ route('adm.banners.edit', ['id' => $banner->id]) }}">
                                    <img src="{{ asset($banner->attachment->path) }}" style="width: 150px;" />
                                </a>
                                @endisset
                            </td>
                            <td>
                                <a href="{{ route('adm.banners.edit', ['id' => $banner->id]) }}">{{ $banner->title }}</a>
                            </td>
                            <td>{{ $banner->user->name }}</td>
                            <td>{{ $banner->started_at }}</td>
                            <td>{{ $banner->finished_at }}</td>
                            <td>{{ $banner->display_yn }}</td>
                            <td>{{ $banner->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                {{ $banners->appends(['category_id' => $params['category_id'], 'sub_category_id' => $params['sub_category_id']])->links() }}
                </div>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){

    $('select[name="category_id"]').change(function(){
        $('select[name="sub_category_id"] > option:eq(0)').prop('selected', true);
        $('form[name="frm_banner_search"]').submit();
    });

    $('select[name="sub_category_id"]').change(function(){
        $('form[name="frm_banner_search"]').submit();
    });

});
</script>
@endsection
