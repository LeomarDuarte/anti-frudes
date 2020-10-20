<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CpfRestrictList extends Model
{
    use HasFactory;
    
    protected $table = 'cpf_restrict_list';
    protected $fillable = ['cpf'];
}
