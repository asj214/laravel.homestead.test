@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-xs-12">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="card">
                <div class="card-header">{{ $survey_cfg->name }}</div>
                <div class="card-body">
                    <form method="post" action="{{ route('surveys.store', ['event_id' => $survey_cfg->id]) }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">이름</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                        </div>
                        @if(in_array('birth', $privates))
                        <div class="form-group">
                            <label for="birth">생년월일</label>
                            <input type="text" class="form-control" name="birth" id="birth" placeholder="Ex. 2020.01.02" value="{{ old('birth') }}">
                        </div>
                        @endif
                        @if(in_array('gender', $privates))
                        <div class="form-group">
                            <label for="gender">성별</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="M" {{ (old('gender') == 'M') ? 'checked': '' }}>
                                    <label class="form-check-label" for="inlineRadio1">M</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="F" {{ (old('gender') == 'F') ? 'checked': '' }}>
                                    <label class="form-check-label" for="inlineRadio2">F</label>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(in_array('email', $privates))
                        <div class="form-group">
                            <label for="email">이메일</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="aaa@abc.com" value="{{ old('email') }}">
                        </div>
                        @endif
                        @if(in_array('phone', $privates))
                        <div class="form-group">
                            <label for="phone">연락처</label>
                            <input type="tel" class="form-control" name="phone" id="phone" placeholder="숫자만 입력" value="{{ old('phone') }}">
                        </div>
                        @endif
                        <button type="submit" class="btn btn-primary">Sign in</button>
                        <a href="{{ url()->previous() }}" class="btn btn-outline-primary">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
