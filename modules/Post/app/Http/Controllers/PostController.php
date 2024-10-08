<?php

namespace Modules\Post\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Post\Http\Requests\Post\StoreRequest;
use Illuminate\Support\Facades\Auth;
use Modules\Post\Http\Resources\Post\IndexResource;
use Modules\Post\Http\Resources\Post\PostResource;
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
    public function index(Request $request): JsonResource
    {
        $accountId = 1;
        $posts = Post::where('account_id', $accountId)->get();
        return IndexResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $accountID = 1;

        $data = $request->validated();
        $post = Post::create(['account_id' => $accountID, 'title' => $data['title'] ?? '',]);
        $contentItems = collect($data['contentItems'])->map(function ($item) {
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
    public function show($id): PostResource
    {
        $post = Post::with('contentItems')->findOrFail($id);

        $post->contentItems->transform(function ($item) {
            $item->data = json_decode($item->data, true);
            return $item;
        });

        return new PostResource($post);
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
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(['message' => 'Post deleted successfully',], 204);
    }
}
