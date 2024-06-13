<?php

namespace App\Social\Http\Controllers;

use App\Category\Http\Requests\CategoryIndexRequest;
use App\Category\Services\CategoryService;
use App\Social\Services\Tumblr\Data\TumblrCredentials;
use App\Social\Services\Tumblr\TumblrService;
use Eher\OAuth\OAuthException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Tumblr\API\Client;
use Tumblr\API\RequestException;

class TestController
{
    public function index()
    {
        return;
        ini_set('display_errors',0);
//        $service = new TumblrService(new TumblrCredentials(
//            consumerKey: "63mdOtFi04UG3K7EBH3UBZT9WANYXc1Q7MZ5TjMe569kol9GFo",
//            consumerSecret: "FVk4JUqAeVSzoxG69vIOgo97QJIhuVv2uMldytUrNnTL4moxjR",
////            token: "wdo7fhHp88tpUsqcAiQXwBssb7CFG01qxIHF0heZMEh390aDlB",
////            secret: "IkSPEnVastQZ4woVRkrHYioslAKiVuqR0LNCyszP7QMz1hIAyA"
//));
        $consumerKey = "63mdOtFi04UG3K7EBH3UBZT9WANYXc1Q7MZ5TjMe569kol9GFo";
        $consumerSecret = "FVk4JUqAeVSzoxG69vIOgo97QJIhuVv2uMldytUrNnTL4moxjR";
        $token = "wdo7fhHp88tpUsqcAiQXwBssb7CFG01qxIHF0heZMEh390aDlB";
        $tokenSecret = "IkSPEnVastQZ4woVRkrHYioslAKiVuqR0LNCyszP7QMz1hIAyA";

        $client = new Client($consumerKey, $consumerSecret);
        $client->setToken($token, $tokenSecret);
        //$info = $client->getUserInfo();

        $blogName = null;
        foreach ($client->getUserInfo()->user->blogs as $blog) {
            $blogName = $blog->name;
        }
//
        $data = [
            "content" => [
                [
                    "type" => "image",
                    "media" => [
                        [
                            "type" => "image/jpeg",
                            "url" => "https://source.unsplash.com/3tYZjGSBwbk",
                            "width" => "1280",
                            "height" => "1073",
                        ]
                    ],
                    "alt_text" => "Sonic the Hedgehog and friends",
                    "caption" => "I'm living my best life on earth."
                ]
            ]
        ];



//        $data = ["title" => "test 2"];

//        $data =  [
//            "url" => "https://images.unsplash.com/photo-1716319487101-108ceed67fcb?q=80&w=1374&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
//            "type" => "image/jpeg",
//            "width" => "540",
//            "height" => "450"
//        ];

//        $data = [
//            "type" => 'photo',
//            "source" => "https://source.unsplash.com/3tYZjGSBwbk",
//        ];

        $client->createPost($blogName, $data);

    }





    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
