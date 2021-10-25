<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionOption extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'question_options';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ques_id',
        'option_content',
        'option_correct',
    ];

    /**
     * Get question information
     */
    public function question()
    {
        return $this->belongsTo(QuestionDetail::class);
    }
}
