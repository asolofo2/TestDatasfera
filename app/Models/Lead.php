<?php

namespace App\Models;

use App\Models\Contact;
use App\Models\Companie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lead extends Model
{
    use HasFactory;
    protected  $fillable = ['id', 'name', 'responsible_user_id', 'sale'];
    public $timestamps = false;


    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function companie()
    {
        return $this->belongsTo(Companie::class);
    }
}
