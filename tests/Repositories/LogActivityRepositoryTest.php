<?php namespace Tests\Repositories;

use App\Models\LogActivity;
use App\Repositories\LogActivityRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class LogActivityRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var LogActivityRepository
     */
    protected $logActivityRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->logActivityRepo = \App::make(LogActivityRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_log_activity()
    {
        $logActivity = LogActivity::factory()->make()->toArray();

        $createdLogActivity = $this->logActivityRepo->create($logActivity);

        $createdLogActivity = $createdLogActivity->toArray();
        $this->assertArrayHasKey('id', $createdLogActivity);
        $this->assertNotNull($createdLogActivity['id'], 'Created LogActivity must have id specified');
        $this->assertNotNull(LogActivity::find($createdLogActivity['id']), 'LogActivity with given id must be in DB');
        $this->assertModelData($logActivity, $createdLogActivity);
    }

    /**
     * @test read
     */
    public function test_read_log_activity()
    {
        $logActivity = LogActivity::factory()->create();

        $dbLogActivity = $this->logActivityRepo->find($logActivity->id);

        $dbLogActivity = $dbLogActivity->toArray();
        $this->assertModelData($logActivity->toArray(), $dbLogActivity);
    }

    /**
     * @test update
     */
    public function test_update_log_activity()
    {
        $logActivity = LogActivity::factory()->create();
        $fakeLogActivity = LogActivity::factory()->make()->toArray();

        $updatedLogActivity = $this->logActivityRepo->update($fakeLogActivity, $logActivity->id);

        $this->assertModelData($fakeLogActivity, $updatedLogActivity->toArray());
        $dbLogActivity = $this->logActivityRepo->find($logActivity->id);
        $this->assertModelData($fakeLogActivity, $dbLogActivity->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_log_activity()
    {
        $logActivity = LogActivity::factory()->create();

        $resp = $this->logActivityRepo->delete($logActivity->id);

        $this->assertTrue($resp);
        $this->assertNull(LogActivity::find($logActivity->id), 'LogActivity should not exist in DB');
    }
}
