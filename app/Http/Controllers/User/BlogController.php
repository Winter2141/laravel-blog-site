<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use \App\Service\BlogService as blogService;
use \App\Service\UserService as userService;
use \App\Service\CommentService as commentService;

class BlogController extends Controller
{
    
    public function index()
    {
        $blogService = new blogService();
        $userService = new userService();
    
    
        $blogs = $blogService->getAssoc();
        $user_type = $userService->getType(auth()->id());

        return view('.user.blog.index', [
            'blogs' => $blogs,
            'user_type' => $user_type
        ]);
    }

    public function create()
    {
        $userService = new userService();
    
        $user_type = $userService->getType(auth()->id());

        $this->abortUser($user_type);

        return view('.user.blog.create', [
            'user_type' => $user_type
        ]);
    }

    public function store()
    {
        $blogService = new blogService();
        $userService = new userService();
        
    
        $result = $blogService->store(auth()->id());

        $user_type = $userService->getType(auth()->id());

        if ($result != null) {
            return redirect()->route('blogs')->with('success', 'Blog Created Successfully');
        }

        return redirect()->route('blogs')->with('error', 'Blog Created Failed');
    }

    public function show($blog)
    {
        $blogService = new blogService();
        $userService = new userService();
        $commentService = new commentService();

        $blogs = $blogService->getById($blog);
    
        $comments = $commentService->getByBlogId($blogs->id);
        $user_type = $userService->getType(auth()->id());

        return view('.user.blog.show', [
            'blog'=>$blogs,
            'comments' => $comments,
            'user_type' => $user_type
        ]);
    }

    public function edit($blog)
    {
        $blogService = new blogService();
        $userService = new userService();

        
        $blogs = $blogService->getById($blog);
    
        $user_type = $userService->getType(auth()->id());

        $this->abortUser($user_type);

        return view('user.blog.edit', [
            'blog'=>$blogs,
            'user_type' => $user_type
        ]);
    }

    public function update($id, Request $request)
    {
        $blogService = new blogService();
        $commentService = new commentService();
        $blog = [
            'id'=>$id,
            'title'=>$request->title,
            'body'=>$request->body
        ];
        $comment = [
            'id'=>$id,
            'title'=>$request->title
        ];

        if(!$blogService->update( $blog ))
        {
            return redirect()->route('blogs')->with('error', 'Blog Update Failed');
        }
        if(!$commentService->changeBlogTitle( $comment ))
        {
            return redirect()->route('blogs')->with('error', 'Comment Blog Title Update Failed');
        }
        return redirect()->route('blogs')->with('success', 'Blog Update Successfully');
    }

    public function delete($id)
    {
        $blogService = new blogService();
        $commentService = new commentService();
    
        if(!$blogService->deleteById($id))
        {
            return redirect()->route('blogs')->with('error', 'Blog Deleted Failed');
        }
        if(!$commentService->deleteByBlogId($id))
        {
            return redirect()->route('blogs')->with('error', 'Selected Blogs Comment Deleted Failed');
        }

        return redirect()->route('blogs')->with('success', 'Blog Deleted Successfully');
    }

    private function abortUser($user_type)
    {
        if($user_type == User::COMMENT_TYPE)
        {
            abort(403);
        }
    }
}
