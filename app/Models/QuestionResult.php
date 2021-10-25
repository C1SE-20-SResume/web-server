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
        'ques_type',
        'ques_score',
    ];

    /**
     * Get question information
     */
    public function question()
    {
        return $this->belongsTo(QuestionDetail::class);
    }

    /**
     * Get user information
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
