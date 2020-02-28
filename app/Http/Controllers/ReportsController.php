<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use DevDojo\Chatter\Models\Post;
use Carbon\Carbon;
use Laratrust\Models\LaratrustRole as Role;
use Notification;

use App\User;
use App\Notifications\PostReported;

class ReportsController extends Controller
{
    public function post(Post $post) {
        $bde_members = Role::where(['name' => 'bde'])->first()->users;
        $route = '';
        $subject = '';

        if ($post->discussion->post()->first()->id === $post->id) {
            $discussion = $post->discussion;
            $discussion->deleted_at = Carbon::now();
            $discussion->save();

            $subject = 'discussion';
            $route = route('chatter.home');
        } else {
            $post->deleted_at = Carbon::now();
            $post->save();

            $subject = 'post';
            $route = route('chatter.discussion.showInCategory', [
                'category' => $post->discussion->category->slug,
                'slug' => $post->discussion->slug
            ]);
        }

        Notification::send($bde_members, new PostReported($post, $subject));

        return redirect($route);
    }

    public function user(User $user) {
        $user->ban();

        return redirect()->route('chatter.home');
    }
}
