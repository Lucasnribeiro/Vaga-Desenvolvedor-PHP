<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ClientTypes;
use App\Models\Seller;
use App\Models\Phones;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'image_path', 'type_id'];

    public function phones()
    {
        return $this->hasMany(Phones::class);
    }

    public function sellers()
    {
        return $this->belongsToMany(Seller::class)->withTimestamps();
    }

    public function types()
    {
        return $this->belongsTo(ClientTypes::class);
    }
}
