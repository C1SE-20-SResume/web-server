<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobKeyword extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'jobs_keyword';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'job_id',
        'keyword',
        'priority_weight',
    ];

    /**
     * Get invoice information
     */
    public function job()
    {
        return $this->belongsTo(JobDetail::class);
    }
}
