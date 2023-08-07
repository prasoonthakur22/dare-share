<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreatorDetail extends Model
{
    use HasFactory;
    public $table = 'creator_details';

    public $fillable = [
        'creator_id',
        'dare_id',
        'quizze_id',
        'choice_id',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'creator_id' => 'integer',
        'dare_id' => 'integer',
        'quizze_id' => 'integer',
        'choice_id' => 'integer',
        'created_at',
        'updated_at'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'creator_id' => 'nullable',
        'dare_id' => 'nullable',
        'quizze_id' => 'nullable',
        'choice_id' => 'nullable',
        'created_at',
        'updated_at'
    ];
}
