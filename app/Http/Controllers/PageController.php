<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(Category $category){
        $posts = Post::where('is_featured', false)
                    ->with('user', 'categories')
                    ->get();
        $featured = Post::featured()->limit(4)->get();
        // dd($posts);
        return view('front.index', [
            'posts' => $posts,
            'featured' => $featured
        ]);
    }

    public function posts(){
        return view('posts.index');
    }

    public function showPost(Post $post){
        $post = $post->load('user','categories');
        return view('front.posts.show', compact('post'));
    }

    public function showCategory(Category $category){
        $posts = $category->posts()->get();
        return view('front.categories.show', compact('category', 'posts'));
    }
}
