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
                            <th>등록자</th>
                            <th>이름</th>
                            <th>주소</th>
                            <th>건물유형</th>
                            <th>호선</th>
                            <th>층수</th>
                            <th>옵션</th>
                            <th>등록일</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>938</td>
                            <td>번구개름</td>
                            <td>
                                <a href="/adm/toilets/form?id=938">케이티앤지 타워</a>
                            </td>
                            <td>서울특별시 강남구 영동대로 416</td>
                            <td>일반건물</td>
                            <td>정보없음</td>
                            <td>1F</td>
                            <td>실내화장실,주차가능,남녀분리,휴지,세면대</td>
                            <td>2019.12.02</td>
                        </tr>
                        <tr>
                            <td>937</td>
                            <td>번구개름</td>
                            <td>
                                <a href="/adm/toilets/form?id=937">도원빌딩</a>
                            </td>
                            <td>경기도 광명시 오리로856번길 17</td>
                            <td>일반건물</td>
                            <td>정보없음</td>
                            <td>2F</td>
                            <td>실내화장실,남녀분리,휴지,세면대</td>
                            <td>2019.11.30</td>
                        </tr>
                        <tr>
                            <td>936</td>
                            <td>번구개름</td>
                            <td>
                                <a href="/adm/toilets/form?id=936">서울스퀘어</a>
                            </td>
                            <td>서울특별시 중구 한강대로 416</td>
                            <td>일반건물</td>
                            <td>정보없음</td>
                            <td>1F</td>
                            <td>실내화장실,남녀분리,휴지,세면대</td>
                            <td>2019.09.22</td>
                        </tr>
                        <tr>
                            <td>935</td>
                            <td>번구개름</td>
                            <td>
                                <a href="/adm/toilets/form?id=935">신송센타빌딩</a>
                            </td>
                            <td>서울특별시 영등포구 여의나루로 57</td>
                            <td>일반건물</td>
                            <td>정보없음</td>
                            <td>1F</td>
                            <td>실내화장실,주차가능,남녀분리,휴지,세면대</td>
                            <td>2019.09.20</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


    </div>
</div>
@endsection
