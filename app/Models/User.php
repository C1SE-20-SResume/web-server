<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'full_name',
        'gender',
        'date_birth',
        'phone_number',
        'email',
        'password',
        'role_level',
        'api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get job's application information
     */
    public function apply()
    {
        return $this->hasMany(JobApply::class, 'user_id');
    }

    /**
     * Get quiz's result information
     */
    public function result()
    {
        return $this->hasMany(QuestionResult::class, 'user_id');
    }

    /**
     * Get company information
     */
    public function company()
    {
        return $this->belongsTo(UserCompany::class);
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    ];
}
