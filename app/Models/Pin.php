<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pin extends Model
{
    use HasFactory;
    
    //テーブル名
    protected $table = 'pins';

    //idを整数型へ変換
    protected $casts = [
        'id' => 'integer'
    ];

    //可変項目
    protected $fillable =
    [
        'title',
        'content'
    ];
}
