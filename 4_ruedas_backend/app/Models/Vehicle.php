<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $table = 'vehicles';
    protected $fillable = [
        'brand',
        'model',
        'type',
        'vehicle_plate'
    ];
    protected $guarded = [
        'owner_id'
    ];

    protected $attributes = [
        'model' => 'nothing'
    ];

    public function owner(){
        return $this->belongsTo(Owner::class, 'owner_id');
    }

}
