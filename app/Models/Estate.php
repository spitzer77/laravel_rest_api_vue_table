<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estate extends Model
{
    use HasFactory;
    use SoftDeletes;

    //protected $guarded = false;

    protected $fillable = ['name', 'price', 'bedrooms', 'bathrooms', 'storeys', 'garages', 'data'];

    protected $guarded = ['created_at', 'updated_at', 'deleted_at'];
}
