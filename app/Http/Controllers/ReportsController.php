<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use DevDojo\Chatter\Models\Post;
use Carbon\Carbon;

class ReportsController extends Controller
{
    public function post(Post $post) {
        if ($post->discussion->post()->first()->id === $post->id) {
            $discussion = $post->discussion;
            $discussion->deleted_at = Carbon::now();
            $discussion->save();
            return redirect()->route('chatter.home');
        } else {
            $post->deleted_at = Carbon::now();
            $post->save();
            return redirect()->route('chatter.discussion.showInCategory', [
                'category' => $post->discussion->category->slug,
                'slug' => $post->discussion->slug
            ]);
        }

    }
}
