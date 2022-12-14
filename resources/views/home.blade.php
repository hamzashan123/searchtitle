@extends('layouts.admin')

@section('content')

<style>
  .card {
    padding: 20px;
  }


  h6.card-subtitle {
    margin-bottom: 10px;
    font-size: 20px;
  }
</style>
<h6 class="c-grey-900">

</h6>
<div class="py-5">
  <div class="container">
    <div class="row">
      @can('role_access')
      <div class="col-md-4">
        <div class="card">
          <div class="card-block">
            <h4 class="card-title">Total Adminstrators</h4>
            <h6 class="card-subtitle text-muted">{{$usersAdmin}}</h6>
            <a href="{{route('admin.users.index')}}" class="card-link">View List</a>
          </div>
        </div>
      </div>
      @endcan

      <div class="col-md-4">
        <div class="card">
          <div class="card-block">
            <h4 class="card-title">Total Users</h4>
            <h6 class="card-subtitle text-muted">{{$users}}</h6>
            <a href="{{route('admin.users.index')}}" class="card-link">View List</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-block">
            <h4 class="card-title">Total Uploaded Files</h4>
            <h6 class="card-subtitle text-muted">{{$documents}}</h6>
            <a href="{{route('admin.documents.getdocuments')}}" class="card-link">View List</a>
          </div>
        </div>
      </div>
      <!-- <div class="col-md-4">
        <div class="card">
          <div class="card-block">
            <h4 class="card-title">Total Users</h4>
            <h6 class="card-subtitle text-muted">6</h6>
            <a href="{{route('admin.users.index')}}" class="card-link">View List</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-block">
            <h4 class="card-title">Total Uploaded Files</h4>
            <h6 class="card-subtitle text-muted">6</h6>
            <a href="{{route('admin.documents.getdocuments')}}" class="card-link">View List</a>
          </div>
        </div>
      </div> -->
    </div>
  </div>


</div>
</div>
</div>
</div>
<div class="mT-30"></div>
@endsection
@section('scripts')
@parent

@endsection