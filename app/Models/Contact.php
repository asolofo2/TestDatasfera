<?php

namespace App\Models;

use App\Models\Lead;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;
    protected  $fillable = ['id', 'name'];
    public $timestamps = false;

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }
}
