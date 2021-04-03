<?php

namespace App\Repositories;

use App\Models\Room;
use App\Repositories\BaseRepository;

/**
 * Class RoomRepository
 * @package App\Repositories
 * @version April 2, 2021, 10:43 pm UTC
*/

class RoomRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'name',
        'status'
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
        return Room::class;
    }
}
