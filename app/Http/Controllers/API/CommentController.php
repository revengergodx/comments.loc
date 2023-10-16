<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Reply\StoreRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $sort_direction = request('sort_direction', 'desc');
        $sort_field = request('sort_field', 'creation_time');

        $comments = Comment::where('parent_id', '=', null)->with('user:id,name,email')->join('users', 'users.id', '=', 'comments.user_id')->orderBy($sort_field, $sort_direction)->select('comments.*')->get();
        return CommentResource::collection($comments);
    }

    public function show($id)
    {
        $comment = Comment::whereId($id)
            ->with('user:id,name',
                'replies:id,user_id,parent_id,comment,creation_time',
                'replies.user:id,name')
            ->get();
        return $comment->toArray();
    }

    public function create(StoreRequest $request)
    {
        $data = $request->validated();
        $data['user'] = ucfirst($data['user']);
        $data['creation_time'] = Carbon::now()->toDateTimeString();
        $user = User::firstOrCreate([
            'name' => $data['user'],
            'email' => $data['email']
        ]);



        $user_id = User::where('name', $data['user'])->first();

        Comment::create([
            'user_id' => $user_id->id,
            'comment' => $data['comment'],
            'creation_time' => $data['creation_time']
        ]);

    }

}
