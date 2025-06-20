<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Testing\Fluent\Concerns\Has;

class Kategori extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kategoris';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'nama',
        'deskripsi'];
}
