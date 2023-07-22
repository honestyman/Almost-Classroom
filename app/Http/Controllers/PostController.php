<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Post;
use App\Models\PostUser;
use Illuminate\Support\Facades\Log;
use Exception;

class PostController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
    }

    public function store(Request $request, Group $group)
    {
        $this->authorize('store', [Post::class, $group]);
        try {
            Post::make([
                'name' => $request->name,
                'content' => $request->content,
                'type' => $request->type,
                'deadline' => $request->deadline,
            ])->user()->associate(auth()->user())->group()->associate($group)->save();
            return redirect()->back()->with('success', 'Příspěvek byl úspěšně přidán.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
        return redirect()->back()->with('error', 'Něco se pokazilo.');
    }

    public function show(Group $group, Post $post)
    {
        try {
            $post_user = PostUser::where('post_id', $post->id)->get();
            return view('post', [
                'post' => $post->with('comments')->first(),
                'group' => $group,
                'post_user' => $post_user,
                'finished_user_count' => $post_user->where('finished', 1)->count(),
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
        return redirect()->back()->with('error', 'Něco se pokazilo.');
    }

    public function update(Request $request, Group $group, Post $post)
    {
        try {
            $post->updateOrFail([
                'name' => $request->name,
                'content' => $request->content,
                'type' => $request->type,
                'deadline' => $request->deadline,
            ]);
            return redirect()->back()->with('success', 'Příspěvek byl úspěšně upraven.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
        return redirect()->back()->with('error', 'Něco se pokazilo.');
    }

    public function destroy(Group $group, Post $post)
    {
        try {
            $post->delete();
            return redirect()->route('home')->with('success', 'Příspěvek byl úspěšně smazán.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
        return redirect()->back()->with('error', 'Něco se pokazilo.');
    }

    public function finish(Request $request, Group $group, Post $post)
    {
        try {
            PostUser::updateOrCreate([
                'user_id' => $request->user()->id,
                'post_id' => $post->id,
            ], [
                'user_id' => $request->user()->id,
                'post_id' => $post->id,
                'finished' => $request->finished,
                'post_answer' => $request->post_answer,
            ]);
            return redirect()->route('group.post.show', ['group' => $group->id, 'post' => $post->id]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
        return redirect()->back()->with('error', 'Něco se pokazilo.');
    }
}
