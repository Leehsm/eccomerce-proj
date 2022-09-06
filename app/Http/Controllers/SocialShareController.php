<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SocialShareController extends Controller
{
    public function index()
    {
        $shareButtons = \Share::page(
            '//http://127.0.0.1:8000',
            'Let we help you change your style',
        )
        ->facebook()
        ->twitter()
        ->telegram()
        ->whatsapp();
  
        $posts = Post::get();
  
        return view('frontend.product.product_details', compact('shareButtons', 'posts'));
    }
}
