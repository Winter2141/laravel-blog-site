@extends('admin.layouts.admin')

@section('user')
    active
@endsection

@section('content')
    @csrf
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">User Table</h1>
    </div>

    @include('admin.layouts.flash')

    <table class="table table-hover table-striped mt-2" width="100%">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Type</th>
            <th>Create At</th>
            <th>Update At</th>
            <th>Action</th>
        </tr>
        @foreach ($users as $user)
        @if ($user->user_type == "admin")
            @continue
        @endif
        <tr>
            <td>{{$loop->index}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->user_type}}</td>
            <td>{{$user->created_at}}</td>
            <td>{{$user->updated_at}}</td>
            <td>
            <button class="btn btn-danger" data-id="{{$user->id}}" data-toggle="modal" data-target="#delete_modal">DEL</button> 
            <button class="btn btn-primary" data-id="{{$user->id}}" data-name="{{$user->name}}" data-email="{{$user->email}}" data-type="{{$user->user_type}}" data-toggle="modal" data-target="#user_edit_modal">Edit</button>
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
              <div class="modal-body">Do you want to delete selected user?</div>
              <div class="modal-footer">
                <form action="{{ route('admin.user.delete', ['user'=>3]) }}" method="POST">
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
    <div class="modal fade modal-danger" id="user_edit_modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form method="POST" action="{{ route('admin.user.update', ['user'=>2]) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="user_name" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" id="user_name" name="user_name" required>
                    </div>
                    <div class="form-group">
                        <label for="user_email" class="col-form-label">Email:</label>
                        <input type="email" class="form-control" id="user_email" name="user_email" required>
                    </div>
                    <div class="form-group">
                        <label for="user_type" class="col-form-label">UserType:</label>
                        <select name="user_type" id="user_type" name="user_type" style="width: 100%;height: 100%" class="p-2">
                            <option value="blog">Blog</option>
                            <option value="comment">Comment</option>
                        </select>
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