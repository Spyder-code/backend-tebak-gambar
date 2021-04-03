<?php namespace Tests\Repositories;

use App\Models\RoomPlay;
use App\Repositories\RoomPlayRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class RoomPlayRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var RoomPlayRepository
     */
    protected $roomPlayRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->roomPlayRepo = \App::make(RoomPlayRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_room_play()
    {
        $roomPlay = RoomPlay::factory()->make()->toArray();

        $createdRoomPlay = $this->roomPlayRepo->create($roomPlay);

        $createdRoomPlay = $createdRoomPlay->toArray();
        $this->assertArrayHasKey('id', $createdRoomPlay);
        $this->assertNotNull($createdRoomPlay['id'], 'Created RoomPlay must have id specified');
        $this->assertNotNull(RoomPlay::find($createdRoomPlay['id']), 'RoomPlay with given id must be in DB');
        $this->assertModelData($roomPlay, $createdRoomPlay);
    }

    /**
     * @test read
     */
    public function test_read_room_play()
    {
        $roomPlay = RoomPlay::factory()->create();

        $dbRoomPlay = $this->roomPlayRepo->find($roomPlay->id);

        $dbRoomPlay = $dbRoomPlay->toArray();
        $this->assertModelData($roomPlay->toArray(), $dbRoomPlay);
    }

    /**
     * @test update
     */
    public function test_update_room_play()
    {
        $roomPlay = RoomPlay::factory()->create();
        $fakeRoomPlay = RoomPlay::factory()->make()->toArray();

        $updatedRoomPlay = $this->roomPlayRepo->update($fakeRoomPlay, $roomPlay->id);

        $this->assertModelData($fakeRoomPlay, $updatedRoomPlay->toArray());
        $dbRoomPlay = $this->roomPlayRepo->find($roomPlay->id);
        $this->assertModelData($fakeRoomPlay, $dbRoomPlay->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_room_play()
    {
        $roomPlay = RoomPlay::factory()->create();

        $resp = $this->roomPlayRepo->delete($roomPlay->id);

        $this->assertTrue($resp);
        $this->assertNull(RoomPlay::find($roomPlay->id), 'RoomPlay should not exist in DB');
    }
}
