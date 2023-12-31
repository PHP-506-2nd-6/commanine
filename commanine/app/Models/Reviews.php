<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reviews extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'rev_id';
    protected $dates = ['deleted_at'];
    protected $table = 'reviews';
    protected $guarded = [
        'rev_id'
    ];
}