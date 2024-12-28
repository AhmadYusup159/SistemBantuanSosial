<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_name',
        'recipient_count',
        'province',
        'district',
        'sub_district',
        'distribution_date',
        'evidence_path',
        'notes',
        'status',
        'rejection_reason',
        'email'
    ];
}
