@extends('admin.layouts.admin')

@section('title')
    Blog
@endsection


@section('blog')
    active
@endsection

@section('content')
@csrf
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Blog Table</h1>
</div>

@include('admin.layouts.flash')

<table class="table table-hover table-striped mt-2" width="100%">
    <tr>
        <th>#</th>
        <th>Title</th>
        <th>Author</th>
        <th>Create At</th>
        <th>Update At</th>
        <th>Action</th>
    </tr>
    @foreach ($blogs as $blog)
        @php
            $url = route('admin.comment.show', ['blog'=>$blog->id]);
        @endphp
        <tr>
                <td onclick="location.href='{{$url}}'">{{$loop->index + 1}}</td>
                <td onclick="location.href='{{$url}}'">{{$blog->title}}</td>
                <td onclick="location.href='{{$url}}'">{{$blog->auth_name}}</td>
                <td onclick="location.href='{{$url}}'">{{$blog->created_at}}</td>
                <td onclick="location.href='{{$url}}'">{{$blog->updated_at}}</td>
            <td>
                <button class="btn btn-danger" data-id="{{$blog->id}}" data-toggle="modal" data-target="#delete_modal">DEL</button>
                <button class="btn btn-primary" data-id="{{$blog->id}}" data-title="{{$blog->title}}" data-body="{{$blog->body}}" data-toggle="modal" data-target="#edit_modal">Edit</button>
                
            </td>
        </tr>
    @endforeach
</table>
<div class="modal fade modal-danger" id="delete_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-center" id="exampleModalLabel">Delete</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">Do you want to delete selected blog?</div>
        <div class="modal-footer">
            <form action="{{ route('admin.blog.delete', ['blog'=>3]) }}" method="POST">
                @method('delete')
                @csrf
                <input type="hidden" name="select_id" id="select_id" value="">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-warning" id="delete_href">Delete</button>
            </form>
        </div>
        </div>
    </div>
</div>
<div class="modal fade modal-danger" id="edit_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Blog</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="POST" action="{{ route('admin.blog.update', ['blog'=>2]) }}">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="form-group">
                    <label for="title" class="col-form-label">Title:</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="body" class="col-form-label">Description:</label>
                    <textarea class="form-control" style="height:200px;" id="body" name="body" required></textarea>
                </div>
                <input type="hidden" name="edit_id" id="edit_id" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" >Update</button>
            </div>
        </form>
        </div>
      </div>
</div>
@endsection