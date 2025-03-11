<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Post extends Model
{
    use HasFactory;
    protected $fillable = ['slug', 'image', 'title', 'body'];

    public function scopeSearch(Builder $query): void
    {
        $query->where('title', 'like', '%' . request('search') . '%');
    }
}