<?php

namespace App\Repositories;

use App\Models\LogActivity;
use App\Repositories\BaseRepository;

/**
 * Class LogActivityRepository
 * @package App\Repositories
 * @version April 2, 2021, 11:18 pm UTC
*/

class LogActivityRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'room_play_id',
        'name'
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
        return LogActivity::class;
    }
}
