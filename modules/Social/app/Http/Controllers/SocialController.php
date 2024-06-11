<?php

namespace Modules\Social\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Social\Services\Tumblr\Data\TumblrCredentials;
use Modules\Social\Services\Tumblr\TumblrService;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $credentials = new TumblrCredentials(
            key: '63mdOtFi04UG3K7EBH3UBZT9WANYXc1Q7MZ5TjMe569kol9GFo',
            secret: 'show'
        );

        $service = new TumblrService($credentials);
        return $service->test();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('social::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('social::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('social::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
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
