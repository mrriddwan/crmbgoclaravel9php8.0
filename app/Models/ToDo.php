<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDo extends Model
{
    use HasFactory;

    protected $fillable = [
        'todo_created',
        'todo_deadline',
        'contact_id',
        'user_id',
        'task_id',
        'status_id',
        'type_id',
        'priority_id',
        'remark',
        'color_id',
    ];

    public function user(){
        return $this -> belongsTo(User::class);
    }

    public function contact(){
        return $this -> belongsTo(Contact::class);
    }

    public function task(){
        return $this -> belongsTo(Task::class);
    }

    public function type(){
        return $this -> belongsTo(ContactType::class);
    }

    public function status(){
        return $this -> belongsTo(ContactStatus::class);
    }

    public function priority(){
        return $this -> belongsTo(Priority::class);
    }

    public function color(){
        return $this -> belongsTo(TextColor::class);
    }

}
