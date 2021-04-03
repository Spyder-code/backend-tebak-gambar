<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRoomPlayAPIRequest;
use App\Http\Requests\API\UpdateRoomPlayAPIRequest;
use App\Models\RoomPlay;
use App\Repositories\RoomPlayRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class RoomPlayController
 * @package App\Http\Controllers\API
 */

class RoomPlayAPIController extends AppBaseController
{
    /** @var  RoomPlayRepository */
    private $roomPlayRepository;

    public function __construct(RoomPlayRepository $roomPlayRepo)
    {
        $this->roomPlayRepository = $roomPlayRepo;
    }

    /**
     * Display a listing of the RoomPlay.
     * GET|HEAD /roomPlays
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $roomPlays = $this->roomPlayRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($roomPlays->toArray(), 'Room Plays retrieved successfully');
    }

    /**
     * Store a newly created RoomPlay in storage.
     * POST /roomPlays
     *
     * @param CreateRoomPlayAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateRoomPlayAPIRequest $request)
    {
        $input = $request->all();

        $roomPlay = $this->roomPlayRepository->create($input);

        return $this->sendResponse($roomPlay->toArray(), 'Room Play saved successfully');
    }

    /**
     * Display the specified RoomPlay.
     * GET|HEAD /roomPlays/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var RoomPlay $roomPlay */
        $roomPlay = $this->roomPlayRepository->find($id);

        if (empty($roomPlay)) {
            return $this->sendError('Room Play not found');
        }

        return $this->sendResponse($roomPlay->toArray(), 'Room Play retrieved successfully');
    }

    /**
     * Update the specified RoomPlay in storage.
     * PUT/PATCH /roomPlays/{id}
     *
     * @param int $id
     * @param UpdateRoomPlayAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRoomPlayAPIRequest $request)
    {
        $input = $request->all();

        /** @var RoomPlay $roomPlay */
        $roomPlay = $this->roomPlayRepository->find($id);

        if (empty($roomPlay)) {
            return $this->sendError('Room Play not found');
        }

        $roomPlay = $this->roomPlayRepository->update($input, $id);

        return $this->sendResponse($roomPlay->toArray(), 'RoomPlay updated successfully');
    }

    /**
     * Remove the specified RoomPlay from storage.
     * DELETE /roomPlays/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var RoomPlay $roomPlay */
        $roomPlay = $this->roomPlayRepository->find($id);

        if (empty($roomPlay)) {
            return $this->sendError('Room Play not found');
        }

        $roomPlay->delete();

        return $this->sendSuccess('Room Play deleted successfully');
    }
}
