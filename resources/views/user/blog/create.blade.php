@extends('user.layouts.main')

@section('title')
    Create
@endsection

@php
    use \App\Models\User;
@endphp

@section('isadmin')
    @if ($user_type == User::ADMIN_TYPE)
        <a class="dropdown-item" href=" {{ route('admin') }}">
        Admin Panel
        </a>
    @endif
@endsection

@section('content')
    <div class="container">
        <a href=" {{ route('blogs')}} " class="bt btn-secondary p-2 rounded">BACK</a>
    <h1 class="text-center m-5 font-weight-bold">Create Blogs</h1>
    {{ Form::open(['route' => 'user.blog.store']) }}
        @csrf
        <div class="form-group">
            {{ Form::label('title', 'Title') }}
            {{ Form::text('title', old('title') ? old('title') : '' ,[
                'class'=>'border block',
                'id'=>'title'
            ]) }}
            @error('title')
            <small class="bg-warning p-2 rounded mt-3">{{$message}}</small>
            @enderror
        </div>

        <div class="form-group">
            {{ Form::label('body', 'Blog Description')}}
            {{ Form::textarea('body', old('body') ? old('body') : '' ,[
                'cols'=>'30',
                'rows'=>'10'
            ])}}
            @error('body')
                <small class="bg-warning p-2 rounded mt-3">{{$message}}</small>
            @enderror
        </div>
        <button class="d-block btn-primary mt-3 p-2 float-right rounded" type="submit">Save</button>
    {{ Form::close()}}
    <!--form method="POST" action="" class="m-lg-5"-->
        
        
    <!--/form-->
</div>
@endsection