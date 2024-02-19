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

<form method="post" action="{{ route('admin_category_update_category_api', $data) }}" enctype="multipart/form-data">

    <div class="form-group mb-3">
        <label>Order</label>
        <input type="text" class="form-control" value="{{$data['order']}}" name="order" value="100"/>
    </div>

    <div class="form-group mb-3">
        <label>Category name</label>
        <input type="text" class="form-control" value="{{$data['name']}}" name="name" />
    </div>

    <input type="submit" value="CONFIRM" class="btn btn-success">

</form>


<div class="card mt-5 mb-5">
    <div style="display: flex; align-items:center; justify-content:space-between" class="card-header">
        <span></span>

        <span class="d-flex">
            <a href="{{route("settings.urls_add_admin_urls_web", $data)}}" class="btn btn-success">New Url</a>
        </span>

    </div>
</div>

<div class="row">
    <div class="col-12 mb-2">
        <input type="text" class="form-control" placeholder="Search your url name..." id="search_url" />
    </div>
</div>

<div style="overflow-y: scroll" class="table_wrapper">
    <table style="min-width: 25rem;" class="table">
        <thead class="bg-dark text-light">
            <tr>
                <th scope="col">#</th>
                <th id="is_copy" scope="col">Sorten Url</th>
                <th scope="col">Url</th>
                <th scope="col">View</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody id="table_data">
            @foreach ($urls as $item)
                <tr>
                    <th scope="row">{{$item['id']}}</th>
                    <td class="text_copy">{{route("settings.urls_admin_urls_links_web")}}/{{$item['uniqeKey']}}</td>
                    <td><input type="text" style="min-width:6rem" value="{{$item['url']}}" class="form-control"></td>
                    <td>{{$item['view']}}</td>
                    <td>
                        <a href="{{route("settings.urls_update_admin_urls_web", [$item, $data])}}" class="btn btn-success">UPDATE</a>
                        <a href="{{route("admin_urls_delete_urls_api", ['id' => $item['id']])}}" class="btn btn-danger">DELETE</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endsection
