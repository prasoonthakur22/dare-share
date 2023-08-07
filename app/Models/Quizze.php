<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quizze extends Model
{
    use HasFactory;
    public $table = 'quizzes';

    public $fillable = [
        'dare_id',
        'question',
        'ask_question',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'dare_id' => 'integer',
        'question' => 'string',
        'ask_question' => 'string',
        'created_at' => 'string',
        'updated_at' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'dare_id' => 'nullable',
        'question' => 'nullable',
        'ask_question' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];


    public function choices()
    {
        return $this->hasMany(Choice::class);
    }
}
