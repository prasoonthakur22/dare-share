<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponderDetail extends Model
{
    use HasFactory;

    public $table = 'responder_details';

    public $fillable = [
        'responder_id',
        'anwered_counts',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'responder_id' => 'integer',
        'anwered_counts' => 'integer',
        'created_at',
        'updated_at'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'responder_id' => 'nullable',
        'anwered_counts' => 'nullable',
        'created_at',
        'updated_at'
    ];
}
