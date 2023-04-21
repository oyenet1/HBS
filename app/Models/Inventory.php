<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventory extends Model
{
    use HasFactory;
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        // creation of automatic patient id
        self::creating(function ($model) {
            $model->patient_id = IdGenerator::generate(['table' => 'inventories', 'field' => 'code', 'length' => 10, 'prefix' => 'INV-' . date('y') . '-']);
        });
    }

}