<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobDetail extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'jobs_detail';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'job_title',
        'job_descrip',
        'salary',
        'job_place',
    ];

    /**
     * Get invoice information
     */
    public function keyword()
    {
        return $this->hasMany(JobKeyword::class);
    }
}
