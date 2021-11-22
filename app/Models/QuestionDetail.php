<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionDetail extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'question_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'type_id',
        'ques_content',
    ];

    /**
     * Get question's option information
     */
    public function option()
    {
        return $this->hasMany(QuestionOption::class, 'ques_id');
    }

    /**
     * Get question's type information
     */
    public function type()
    {
        return $this->belongsTo(QuestionType::class);
    }
    
    /**
     * Get company information
     */
    public function company()
    {
        return $this->belongsTo(UserCompany::class);
    }
}
