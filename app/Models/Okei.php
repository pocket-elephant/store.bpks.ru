<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Okei extends Model
{
    /** @use HasFactory<\Database\Factories\OkeiFactory> */

    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'conventionalNationalView',
        'conventionalInternationalView',
        'symbolNationalView',
        'symbolInternationalView',
    ];
}
