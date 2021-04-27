<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class RoomPlay
 * @package App\Models
 * @version April 2, 2021, 11:14 pm UTC
 *
 * @property integer $room_id
 * @property integer $user_id
 * @property integer $point
 */
class RoomPlay extends Model
{

    use HasFactory;

    public $table = 'room_plays';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'room_id',
        'user_id',
        'point',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'room_id' => 'integer',
        'user_id' => 'integer',
        'point' => 'integer',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


}
