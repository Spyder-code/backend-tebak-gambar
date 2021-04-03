<?php

namespace App\Repositories;

use App\Models\RoomPlay;
use App\Repositories\BaseRepository;

/**
 * Class RoomPlayRepository
 * @package App\Repositories
 * @version April 2, 2021, 11:14 pm UTC
*/

class RoomPlayRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'room_id',
        'user_id',
        'point'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return RoomPlay::class;
    }
}
