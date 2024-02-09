<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'phone', 'country', 'person', 'book_date', 'book_time', 'menu','amount', 'payment', 'affiliate'];
}
