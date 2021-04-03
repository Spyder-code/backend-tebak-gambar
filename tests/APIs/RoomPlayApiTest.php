<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\RoomPlay;

class RoomPlayApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_room_play()
    {
        $roomPlay = RoomPlay::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/room_plays', $roomPlay
        );

        $this->assertApiResponse($roomPlay);
    }

    /**
     * @test
     */
    public function test_read_room_play()
    {
        $roomPlay = RoomPlay::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/room_plays/'.$roomPlay->id
        );

        $this->assertApiResponse($roomPlay->toArray());
    }

    /**
     * @test
     */
    public function test_update_room_play()
    {
        $roomPlay = RoomPlay::factory()->create();
        $editedRoomPlay = RoomPlay::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/room_plays/'.$roomPlay->id,
            $editedRoomPlay
        );

        $this->assertApiResponse($editedRoomPlay);
    }

    /**
     * @test
     */
    public function test_delete_room_play()
    {
        $roomPlay = RoomPlay::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/room_plays/'.$roomPlay->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/room_plays/'.$roomPlay->id
        );

        $this->response->assertStatus(404);
    }
}
