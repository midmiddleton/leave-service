<?php

namespace Tests\Feature\LeaveRequests;

use Tests\TestCase;
use App\Models\LeaveRequest;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UpdateTest extends TestCase
{
    use DatabaseMigrations;

    public function test_the_application_returns_a_successful_response(): void
    {
        $leaveRequest = LeaveRequest::factory()->create();

        $response = $this->put('api/leave-requests/' . $leaveRequest->id, [
            'reason' => 'changed reason',
        ]);

        $response->assertStatus(200);
    }

    public function test_the_application_returns_a_leave_request(): void
    {
        $leaveRequest = LeaveRequest::factory()->create();

        $response = $this->put('api/leave-requests/' . $leaveRequest->id, [
    
            'status' => 'changed-status',

        ]);

        $response->assertStatus(200);
    }

    public function test_the_application_returns_a_422_response_when_user_id_is_missing(): void
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
        $leaveRequest = LeaveRequest::factory()->create();

        $response = $this->put('api/leave-requests/' . $leaveRequest->id, [
            'user_id' => null,
  
        ]);

        $response->assertStatus(422);
    }
}