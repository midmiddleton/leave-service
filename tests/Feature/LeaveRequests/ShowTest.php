<?php

namespace Tests\Feature\LeaveRequests;

use App\Models\LeaveRequest;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ShowTest extends \Tests\TestCase
{

    use DatabaseMigrations;

    public function test_the_application_returns_a_successful_response(): void
    {
        $leaveRequests = LeaveRequest::factory()->count(3)->create();

        $response = $this->get('api/leave-requests/' . $leaveRequests->first()->id);

        $response->assertStatus(200);
    }

    public function test_the_application_returns_a_leave_request(): void
    {
        LeaveRequest::factory()->count(3)->create();
        $response = $this->get('api/leave-requests/' . LeaveRequest::first()->id);

        $response->assertStatus(200);
    }
}