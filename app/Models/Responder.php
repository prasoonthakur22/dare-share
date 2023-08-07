<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responder extends Model
{
    use HasFactory;

    public $table = 'responders';

    public $fillable = [
        'creator_id',
        'dare_id',
        'name',
        'responder_ip',
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
        'name' => 'string',
        'responder_ip' => 'string',
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
        'name' => 'nullable',
        'responder_ip' => 'nullable',
        'created_at',
        'updated_at'
    ];

    public function responderDetails()
    {
        return $this->hasMany(ResponderDetail::class);
    }
}
