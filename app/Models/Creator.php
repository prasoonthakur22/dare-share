<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Creator extends Model
{
    use HasFactory;

    public $table = 'creators';

    public $fillable = [
        'dare_id',
        'name',
        'creator_ip',
        'share_url',
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
        'name' => 'string',
        'creator_ip' => 'string',
        'share_url' => 'string',
        'created_at',
        'updated_at'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'dare_id' => 'nullable',
        'name' => 'nullable',
        'creator_ip' => 'nullable',
        'share_url' => 'nullable',
        'created_at',
        'updated_at'
    ];
}
