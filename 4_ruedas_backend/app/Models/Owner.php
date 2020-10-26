<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Owner extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $table = 'owners';
    protected $fillable = [
       'name',
       'last_name',
       'dni'
    ];
    protected $guarded = [
      'user_id'
    ];
    protected $appends = [
        'full_name'
    ];
    protected $casts = [
        'dni' => 'integer'
    ];


    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function vehicles(){
        return $this->hasMany(Vehicle::class, 'owner_id');
    }

    public function getFullNameAttribute(){
        return "{$this->name}  {$this->last_name}";
    }

}
