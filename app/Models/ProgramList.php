<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramList extends Model
{
    /** @use HasFactory<\Database\Factories\ProgramListFactory> */
    use HasFactory;
    protected $fillable = ['slug', 'title', 'date', 'location'];
}
