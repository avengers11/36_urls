@extends('admin.layout.master')
@section('admin_master')

<style>
    .tox-promotion {
        display: none;
    }
    span.tox-statusbar__branding {
        display: none;
    }
</style>

<div class="container">
    @if (session() -> has('msg'))
    <div class="alert alert-primary d-flex align-items-center mt-5" role="alert">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </svg>
        <div>
            {{session() -> get('msg')}}
        </div>
    </div>
    @endif

    <div class="card-body">
        <form action="{{route("admin_urls_update_urls_api", $url)}}" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-12 mb-3">
                    <label for="">Select category</label>
                    <select name="category_id" class="form-select">
                        @foreach ($cat as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 mb-3">
                    <input type="text" class="form-control" placeholder="Your title name..." value="{{$url['title']}}" name="title" />
                </div>
                <div class="col-12 mb-3">
                    <img style="width: 5rem" src="{{asset('images/og/'.$url['og'])}}" alt="">
                    <label for="">Upload og img</label>
                    <input type="file" class="form-control" name="og" />
                </div>
                <div class="col-12 mb-3">
                    <input type="text" class="form-control" placeholder="Your uniqe key name..." name="uniqeKey" value="{{$url['uniqeKey']}}" />
                </div>
                <div class="col-12 mb-3">
                    <input type="text" class="form-control" placeholder="Your url address..." name="url" value="{{$url['url']}}" />
                </div>
                <div class="col-12 mb-3">
                    <label for="">Select auth type</label>
                    <select name="auth" value="{{$url['auth']}}" class="form-select">
                        <option value="{{$url['auth']}}">@if($url['auth'] == 0) Public @else Private  @endif</option>
                        <option value="0" @if($url['auth'] == 0) class="d-none" @endif>Public</option>
                        <option value="1" @if($url['auth'] == 1) class="d-none" @endif>Private</option>
                    </select>
                </div>
                <div class="col-12 mb-3">
                    <label for="">Select page type</label>
                    <select name="view_page" value="{{$url['view_page']}}" class="form-select">
                        <option value="{{$url['view_page']}}">@if($url['view_page'] == 0) Default @else Custom  @endif</option>
                        <option value="0" @if($url['view_page'] == 0) class="d-none" @endif>Default</option>
                        <option value="1" @if($url['view_page'] == 1) class="d-none" @endif>Custom</option>
                    </select>
                </div>
                <div class="col-12 mb-3">
                    <input type="text" class="form-control" placeholder="Loading time..." name="time" value="{{$url['time']}}"  value="10"/>
                </div>
                <div class="col-12 mb-3">
                    <textarea name="custom_page" id="description" cols="30" rows="10" class="form-control">{{$url['custom_page']}}</textarea>
                </div>
            </div>
            <input type="submit" class="btn btn-primary" value="CONFIRM">
        </form>
    </div>
</div>

@endsection
