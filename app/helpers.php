<?php

use App\Models\Post;
use Illuminate\Support\Str;

if (!function_exists('stringLimit')) {
  function stringLimit($text, $limit = 100) {
    if (mb_strlen($text) <= $limit) {
      return $text;
    }

    return mb_substr($text, 0, $limit) . '...';
  }
}


if (!function_exists('readDuration')) {
  function readDuration(...$text) {
    Str::macro('timeCounter', function ($text) {
      $totalWords = str_word_count(implode(" ", $text));
      $minutesToRead = round($totalWords / 250);
      return (int)max(1, $minutesToRead);
    });
    return Str::timeCounter($text);
  }
}


if (!function_exists('latestPost')) {
  function latestPost() {
    return Post::with('user')->with('category')->limit(1)->orderBy('created_at', 'desc')->first();
  }
}


if (!function_exists('randomPosts')) {
  function randomPosts() {
    return Post::with('user')->with('category')->limit(3)->inRandomOrder()->get();
  }
}


if (!function_exists('randomTwoPosts')) {
  function randomTwoPosts() {
    return Post::with('user')->with('category')->inRandomOrder()->limit(2)->get();
  }
}


if (!function_exists('recentPosts')) {
  function recentPosts() {
    return Post::with('user')->with('category')->limit(3)->orderBy('created_at', 'desc')->get();
  }
}
