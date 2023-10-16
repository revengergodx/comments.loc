<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Reply\StoreRequest;
use App\Models\Comment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(StoreRequest $request)
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
            'parent_id' => $data['parent_id'],
            'creation_time' => $data['creation_time']
        ]);
    }
}
