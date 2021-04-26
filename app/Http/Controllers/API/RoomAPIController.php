<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRoomAPIRequest;
use App\Http\Requests\API\UpdateRoomAPIRequest;
use App\Models\Room;
use App\Repositories\RoomRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\RoomPlay;
use Response;

/**
 * Class RoomController
 * @package App\Http\Controllers\API
 */

class RoomAPIController extends AppBaseController
{
    /** @var  RoomRepository */
    private $roomRepository;

    public function __construct(RoomRepository $roomRepo)
    {
        $this->roomRepository = $roomRepo;
    }

    /**
     * Display a listing of the Room.
     * GET|HEAD /rooms
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        // $rooms = $this->roomRepository->all(
        //     $request->except(['skip', 'limit']),
        //     $request->get('skip'),
        //     $request->get('limit')
        // );

        $rooms = Room::all();
        $a = 0;
        foreach ($rooms as $item ) {
            $data = Room::find($item->id)->roomPlay()->count();
            $rooms[$a]['total'] = $data;
            $a++;
        }

        return $this->sendResponse($rooms->toArray(), 'Rooms retrieved successfully');
    }

    /**
     * Store a newly created Room in storage.
     * POST /rooms
     *
     * @param CreateRoomAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateRoomAPIRequest $request)
    {
        $input = $request->all();

        $room = $this->roomRepository->create($input);

        return $this->sendResponse($room->toArray(), 'Room saved successfully');
    }

    /**
     * Display the specified Room.
     * GET|HEAD /rooms/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {

        $room = RoomPlay::join('rooms','rooms.id','=','room_plays.room_id')
        ->join('users','users.id','=','room_plays.user_id')
        ->where('room_id',$id)->select('rooms.name as room_name','users.name as user_name')->get();

        if (empty($room)) {
            return $this->sendError('Room not found');
        }

        dd($room);
        return $this->sendResponse($room->toArray(), 'Room retrieved successfully');
    }

    /**
     * Update the specified Room in storage.
     * PUT/PATCH /rooms/{id}
     *
     * @param int $id
     * @param UpdateRoomAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRoomAPIRequest $request)
    {
        $input = $request->all();

        /** @var Room $room */
        $room = $this->roomRepository->find($id);

        if (empty($room)) {
            return $this->sendError('Room not found');
        }

        $room = $this->roomRepository->update($input, $id);

        return $this->sendResponse($room->toArray(), 'Room updated successfully');
    }

    /**
     * Remove the specified Room from storage.
     * DELETE /rooms/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Room $room */
        $room = $this->roomRepository->find($id);

        if (empty($room)) {
            return $this->sendError('Room not found');
        }

        $room->delete();

        return $this->sendSuccess('Room deleted successfully');
    }
}
