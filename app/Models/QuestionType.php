<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionType extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'question_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type_name',
    ];

    /**
     * Get question information
     */
    public function question()
    {
        return $this->hasMany(QuestionDetail::class, 'type_id');
    }

    /**
     * Get quiz's result information
     */
    public function result()
    {
        return $this->hasMany(QuestionResult::class, 'type_id');
    }
}
