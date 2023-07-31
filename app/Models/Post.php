<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model {
  use HasFactory;

  protected $fillable = [
    'title',
    'content',
    'tags',
    'image',
    'category_id'
  ];



  public function category() {
    return $this->belongsTo(Category::class);
  }

  public function scopeSearch($query, $term) {
    $search = '%' . $term . '%';
    $query->where(function ($query) use ($search) {
      $query->where('title', 'LIKE', $search);
    });
  }

  public function user() {
    return $this->belongsTo(User::class);
  }
}
