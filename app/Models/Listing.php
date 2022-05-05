<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
  use HasFactory;

  protected $fillable = ['title', 'company', 'location', 'website', 'email', 'tags', 'description', 'logo', 'user_id'];

  public function scopeFilter($query, array $filters){
    if($filters['tag'] ?? false){
      $query->where('tags', 'LIKE', '%' . request('tag') . '%');
    };

    if($filters['search'] ?? false){
      $query->where('title', 'LIKE', '%' . request('search') . '%')
            ->orWhere('description', 'LIKE', '%' . request('search') . '%')
            ->orWhere('tags', 'LIKE', '%' . request('search') . '%');
    };
  }

  // Relationships to User
  public function user(){
    return $this->belongsTo(User::class, 'user_id');
  }
}