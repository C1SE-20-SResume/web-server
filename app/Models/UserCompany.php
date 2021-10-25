<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCompany extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_companies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_name',
        'logo_url',
    ];

    /**
     * Get user information
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'company_id');
    }

    /**
     * Get job detail information
     */
    public function job()
    {
        return $this->hasMany(JobDetail::class, 'company_id');
    }
}
