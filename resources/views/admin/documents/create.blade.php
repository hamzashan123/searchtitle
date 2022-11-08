@extends('layouts.admin')
@section('content')
<h6 class="c-grey-900">
   Upload Document
</h6>
<div class="mT-30">
    <form action="{{ route("admin.documents.store") }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Document*</label>
            <input type="file" id="name" name="name" class="form-control"  required>
        </div>
      
     
      
        <div>
            <input class="btn btn-danger" type="submit" value="Upload">
        </div>
    </form>
</div>
@endsection
