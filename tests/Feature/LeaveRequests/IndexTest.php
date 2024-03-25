<?php

namespace Tests\Feature\LeaveRequests;

use App\Models\LeaveRequest;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use DatabaseMigrations;


    public function test_the_application_returns_a_successful_response(): void
    {
        LeaveRequest::factory()->count(3)->create();
        $response = $this->get('api/leave-requests');


        $response->assertStatus(200);
    }

    public function test_the_application_returns_a_list_of_leave_requests(): void
    {
        LeaveRequest::factory()->count(3)->create();

        $response = $this->get('api/leave-requests');

        $response->assertStatus(200);
    }
}