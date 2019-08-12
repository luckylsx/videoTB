@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
        <div class="col-md-8">
        <div>
        <div class="col-md-8" style="margin-top: 20px">
            <form method="get" action="{{route('video')}}">
                <div class="form-group">
                    <label for="exampleInputEmail1">视频链接地址</label>
                    <input name="video_link" class="form-control" id="exampleInputEmail1" placeholder="视频链接地址">
                    @if($errors->has('video_link'))
                        <span style="color: red">{{$errors->first('video_link')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">视频名称</label>
                    <input name="video_new_name" class="form-control" id="exampleInputPassword1" placeholder="视频名称">
                    @if($errors->has('video_new_name'))
                        <span style="color: red">{{$errors->first('video_new_name')}}</span>
                    @endif
                    @if($errors->has('auth_url'))
                        <span style="color: red">{{$errors->first('auth_url')}}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-default">解析视频并下载</button>
            </form>

        </div>
    </div>
</div>
@endsection
