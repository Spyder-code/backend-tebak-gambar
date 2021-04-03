<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class LogActivity
 * @package App\Models
 * @version April 2, 2021, 11:18 pm UTC
 *
 * @property integer $room_play_id
 * @property string $name
 */
class LogActivity extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'log_activities';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'room_play_id',
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'room_play_id' => 'integer',
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
