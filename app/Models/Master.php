<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    use HasFactory;
    protected $table = 'masters';
    protected $fillable = ['nama','detail','id_jenis'];
    protected $hidden = ['created_by','update_at'];
}
