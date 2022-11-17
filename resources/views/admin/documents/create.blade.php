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

        <div class="form-group">
            <label for="users">Users*
                <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
            <select name="users[]" id="users" class="form-control select2" multiple="multiple" required>
                @foreach($users as $id => $user)
                    <option value="{{ $user->id }}">{{ $user->email }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="name">Category*</label>
            <input type="text" id="category" name="category" class="form-control"  required>
        </div>
      
     
      
        <div>
            <input class="btn btn-danger" type="submit" value="Upload">
        </div>
    </form>
</div>
@endsection
