@extends('admin.layout.master')
@section('admin_master')

<!--  -->
<div class="container">
    <div class="row">
        @if (session() -> has('msg'))
            <div class="alert alert-success col-12" role="alert">
                <h4 class="alert-heading">Alert</h4>
                <hr>
                <p>{{session() -> get('msg')}}</p>
            </div>
        @endif
    </div>
</div>

<form method="post" action="{{ route('admin_settings_update_slider_api', ['id' => $sl->id]) }}" enctype="multipart/form-data">



    <div class="form-group mb-3">
        <label>Picture</label>
        <input type="file" class="form-control" name="img"  />
    </div>

    <div class="form-group mb-3">
        <label>Links</label>
        <input type="text" class="form-control" name="links" value="{{$sl->links}}" />
    </div>

    <input type="submit" value="CONFIRM" class="btn btn-success">

</form>


@endsection
