<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerDetail extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'email'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
