<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApply extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'job_applies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'job_id',
        'cv_file',
        'cv_score',
        'pass_status',
        'keyword_found',
        'keyword_not_found',
    ];

    /**
     * Get job's detail information
     */
    public function job()
    {
        return $this->belongsTo(JobDetail::class);
    }

    /**
     * Get user information
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
