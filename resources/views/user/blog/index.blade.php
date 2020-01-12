@extends('user.layouts.main')

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

@section('title')
    Blog
@endsection

@section('content')
    <h1 class="text-center m-5 font-weight-bold">Blog List</h1>
    @csrf
    <div class="container">
        @include('admin.layouts.flash')
        @foreach ($blogs as $blog)
        <div class="card-1 mt-3">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h2>{{$blog->title}}</h2>
                    </div>
                    <div class="col pt-3">
                        <span class="float-right  ml-4">Created At : {{$blog->created_at}}</span><span class="float-right">Author : {{$blog->auth_name}}</span>
                    </div>
                </div>
            </div>
            <div class="card-body d-block overflow-hidden" id="blog_body">
                <h6><?php echo nl2br($blog->body, false)?></h6>
            </div>
            <a class="ml-4" href="{{ route('user.blog.show', ['blog'=>$blog->id]) }}">Show Detail</a>
        </div>
        @endforeach
        @if ($user_type != User::COMMENT_TYPE)
            <a class="mt-3 mr-5 float-right bg-success p-2 mb-5 rounded" href="{{ route('user.blog.create') }}" id="create_blog">Create Blog</a>
        @endif
    </div>
@endsection