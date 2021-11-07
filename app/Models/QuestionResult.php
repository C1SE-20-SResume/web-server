<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionResult extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'question_results';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'type_id',
        'ques_score',
    ];

    /**
     * Get question's type information
     */
    public function type()
    {
        return $this->belongsTo(QuestionType::class);
    }

    /**
     * Get user information
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
