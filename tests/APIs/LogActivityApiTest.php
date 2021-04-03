<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\LogActivity;

class LogActivityApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_log_activity()
    {
        $logActivity = LogActivity::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/log_activities', $logActivity
        );

        $this->assertApiResponse($logActivity);
    }

    /**
     * @test
     */
    public function test_read_log_activity()
    {
        $logActivity = LogActivity::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/log_activities/'.$logActivity->id
        );

        $this->assertApiResponse($logActivity->toArray());
    }

    /**
     * @test
     */
    public function test_update_log_activity()
    {
        $logActivity = LogActivity::factory()->create();
        $editedLogActivity = LogActivity::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/log_activities/'.$logActivity->id,
            $editedLogActivity
        );

        $this->assertApiResponse($editedLogActivity);
    }

    /**
     * @test
     */
    public function test_delete_log_activity()
    {
        $logActivity = LogActivity::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/log_activities/'.$logActivity->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/log_activities/'.$logActivity->id
        );

        $this->response->assertStatus(404);
    }
}
