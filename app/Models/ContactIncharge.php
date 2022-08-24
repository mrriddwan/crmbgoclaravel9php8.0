<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactIncharge extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone_mobile',
        'phone_office',
    ];

    public function contact(){
        return $this->belongsTo(Contact::class);
    }
}
