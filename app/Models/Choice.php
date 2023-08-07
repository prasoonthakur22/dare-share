<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    use HasFactory;
    public $table = 'choices';

    public $fillable = [
        'quizze_id',
        'answer',
        'answer_image',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'quizze_id' => 'integer',
        'answer' => 'string',
        'answer_image' => 'string',
        'created_at' => 'string',
        'updated_at' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'quizze_id' => 'nullable',
        'answer' => 'nullable',
        'answer_image' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];


    public function paraentQuizze()
    {
        return $this->belongsTo(Quizze::class);
    }
}
