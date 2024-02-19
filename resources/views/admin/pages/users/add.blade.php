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

<form method="post" action="{{ route('admin_users_add_api') }}">

    <div class="form-group mb-3">
        <label>Username</label>
        <input type="text" class="form-control" name="username" placeholder="Username..." required />
    </div>

    <div class="form-group mb-3">
        <label>Password</label>
        <input type="text" class="form-control" name="password" placeholder="Password..." required />
    </div>

    <div class="form-group mb-3">
        <label>Login time</label>
        <input type="number" class="form-control" name="login_time" placeholder="Login time..." required />
    </div>

    <div class="form-group mb-3">
        <label>Expired date</label>
        <input type="number" class="form-control" name="expired" placeholder="Expired date..." required />
    </div>

    <div class="form-group mb-3">
        <label>Account Type</label>
        <select name="role" class="form-select">
            <option value="0">USERS</option>
            @if(admin_data(session() -> get('username'))['role'] == "1")
                <option value="2">RESELLER</option>
            @endif
        </select>
    </div>

    <input type="submit" value="CONFIRM" class="btn btn-success">

</form>


@endsection
