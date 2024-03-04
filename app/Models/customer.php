<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email','party','packages','birthday', 'phone', 'country', 'person', 'book_time', 'menu','amount', 'payment', 'affiliate'];
}
