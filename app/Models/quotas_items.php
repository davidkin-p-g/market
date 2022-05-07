<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quotas_items extends Model
{
    protected $guarded = ['id_quotas_item','quotas_id', 'isDelete', 'created_at', 'updated_at'];
}
