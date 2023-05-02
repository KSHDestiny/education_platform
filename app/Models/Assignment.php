<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;
    protected $fillable=['assignment_id','course_id','student_id','assignment_no','assignment_link','submission','assignment_status'];
}
