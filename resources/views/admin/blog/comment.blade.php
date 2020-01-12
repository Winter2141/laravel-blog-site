@extends('admin.layouts.admin')

@section('title')
    {{ $blog_title }}'s Comments
@endsection

@section('comment')
    active
@endsection

@section('content')
@csrf
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
  <a href="{{ route('admin.blog.show') }}" style="color:black;"><h1>{{ $blog_title }}'s Comment Table</h1></a>
</div>

@include('admin.layouts.flash')
@if ($comments->count() == 0)
<h2 class="text-center">{{ $blog_title }} has not comment</h2>
@else
  <table class="table table-hover table-striped mt-2 text-center table-dark" width="100%">
      <tr>
          <th>#</th>
          <th>Blog Title</th>
          <th>Author</th>
          <th width="30%">Message</th>
          <th>Create At</th>
          <th>Update At</th>
          <th>Action</th>
      </tr>
      @foreach ($comments as $comment)
      <tr>
          <td>{{$loop->index + 1}}</td>
          <td>{{$comment->title}}</td>
          <td>{{$comment->auth_name}}</td>
          <td><?php echo nl2br($comment->body);?></td>
          <td>{{$comment->created_at}}</td>
          <td>{{$comment->updated_at}}</td>
          <td>
              <button class="btn btn-primary" data-id="{{$comment->id}}" data-title="{{$comment->title}}" data-body="{{$comment->body}}" data-toggle="modal" data-target="#edit_modal">Edit</button> 
              <button class="btn btn-danger" data-id="{{$comment->id}}" data-toggle="modal" data-target="#delete_modal">DEL</button>           
          </td>
      </tr>
      @endforeach
  </table>
@endif

<div class="modal fade modal-danger" id="delete_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-center" id="exampleModalLabel">Delete</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Do you want to delete selected comment?</div>
          <div class="modal-footer">
            <form action="{{ route('admin.comment.delete', ['comment'=>3]) }}" method="POST">
                @method('delete')
                @csrf
                <input type="hidden" name="select_id" id="select_id"  value="">
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
            <h5 class="modal-title" id="exampleModalLabel">Edit Comment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="POST" action="{{ route('admin.comment.update', ['comment'=>2]) }}">
            @csrf
            @method('PUT')
            <div class="modal-body">
                    <input type="hidden" class="form-control" id="title" name="title">
                <div class="form-group">
                    <label for="body" class="col-form-label">message:</label>
                    <textarea class="form-control"  id="body" name="body" required></textarea>
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