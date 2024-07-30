<?php

namespace Modules\Post\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Post\Http\Requests\Post\StoreRequest;
use Illuminate\Support\Facades\Auth;
use Modules\Post\Models\ContentItem;
use Modules\Post\Models\Post;
use Modules\User\Models\Account;
use Modules\User\Models\User;

class PostController extends Controller
{
//    public function __construct(
//        private Guard $auth
//    ) {
//
//    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $auth = Auth::user();
        $user = auth()->id();
        $request->session()->all();
        var_dump($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $userId = auth()->id();
        $accountID = 1;

        $data = $request->validated();
        $post = Post::create(['account_id' => $accountID, 'title' => $request->input('title'),]);
        $contentItems = collect($request->input('contentItems'))->map(function ($item) {
            return [
                'type' => 'EditorJS',
                'data' => json_encode($item),
            ];
        })->toArray();

        $post->contentItems()->createMany($contentItems);

        return response()->json(['message' => 'Post created successfully', 'post' => $post], 201);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('post::show');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
