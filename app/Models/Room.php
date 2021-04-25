<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Room
 * @package App\Models
 * @version April 2, 2021, 10:43 pm UTC
 *
 * @property integer $user_id
 * @property string $name
 * @property integer $status
 */
class Room extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'rooms';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'name',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'name' => 'string',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];

    public function roomPlay()
    {
        return $this->hasMany(RoomPlay::class);
    }
}
