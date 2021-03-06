<?php

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use CodeProject\Entities\ProjectNote;
use CodeProject\Entities\ProjectTask;
use CodeProject\Entities\User;
use CodeProject\Entities\ProjectFile;
use CodeProject\Entities\Client;

class Project extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
    'owner_id',
    'client_id',
    'name',
    'description',
    'progess',
    'status',
    'due_date'
    ];

    //Recuperar informações da chave estrangeira
    public function client(){
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function owner(){
        return $this->belongsTo(User::class, 'owner_id');
    }

    //Ver todos os objetos que o projeto possui
    public function notes(){
    	return $this->hasMany(ProjectNote::class);
    }

    public function tasks(){
        return $this->hasMany(ProjectTask::class);
    }


    public function members(){
        return $this->belongsToMany(User::class, 'project_members', 'project_id', 'member_id');
    }

    public function files(){
        return $this->hasMany(ProjectFile::class);
    }

}
