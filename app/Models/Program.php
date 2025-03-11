<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Program extends Model 
{
    use HasFactory;
    protected $fillable = ['slug', 'time', 'date', 'location', 'maps', 'title', 'body'];

    public function scopeSearch(Builder $query): void
    {
        $search = request('search');

        $query->where(function ($query) use ($search) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('location', 'like', "%{$search}%")
                ->orWhereMonth('date', '=', date('m', strtotime($search))); // Menambahkan pencarian berdasarkan bulan
        });
    }

    public function participants()
    {
        return $this->hasMany(Participant::class, 'program_title', 'title');
    }

}