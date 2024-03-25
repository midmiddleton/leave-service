<?php

namespace Tests\Feature\LeaveRequests;

use App\Models\LeaveRequest;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class DestroyTest extends TestCase
{

    use DatabaseMigrations;

    public function test_the_application_returns_a_successful_response(): void
    {
        $leaveRequest = LeaveRequest::factory()->create();

        $response = $this->delete('api/leave-requests/' . $leaveRequest->id);

        $response->assertStatus(204);
    }
}