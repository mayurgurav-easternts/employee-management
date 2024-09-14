<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeLeave extends Model {
    use HasFactory, SoftDeletes;
    // Allow mass assignment of these fields
    protected $fillable = [
        'employee_id',
        'leave_start',
        'leave_end',
        'leave_type',
    ];
}
