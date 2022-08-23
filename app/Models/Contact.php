<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'industry',
        'status',
        'type',
        'category'
    ];

    public function user(){
        return $this -> belongsTo(User::class);
    }

    public function category(){
        return $this -> belongsTo(ContactCategory::class);
    }

    public function type(){
        return $this -> belongsTo(ContactType::class);
    }

    public function status(){
        return $this -> belongsTo(ContactStatus::class);
    }

    public function incharge(){
        return $this -> belongsTo(ContactIncharge::class);
    }
    
}
