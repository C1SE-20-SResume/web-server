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
    protected $table = 'job_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'job_title',
        'job_descrip',
        'job_require',
        'job_benefit',
        'work_time',
        'job_place',
        'salary',
        'date_expire',
        'require_score',
    ];

    /**
     * Get job's keywords information
     */
    public function keyword()
    {
        return $this->hasMany(JobKeyword::class, 'job_id');
    }

    /**
     * Get job's applies information
     */
    public function apply()
    {
        return $this->hasMany(JobApply::class, 'job_id');
    }

    /**
     * Get company information
     */
    public function company()
    {
        return $this->belongsTo(UserCompany::class);
    }
}
