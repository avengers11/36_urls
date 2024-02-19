<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class urls extends Model
{
    use HasFactory;
    protected $table = "urls";
    protected $primaryKey = "id";

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }
}
