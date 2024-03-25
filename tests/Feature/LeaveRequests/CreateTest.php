<?php

namespace Tests\Feature\LeaveRequests;

use App\Models\LeaveRequest;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateTest extends \Tests\TestCase
{
    use DatabaseMigrations;

    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->post('api/leave-requests', [
            'user_id' => 'user_id',
            'leave_type' => 'leave_type',
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDay(),
            'status' => 'status',
            'reason' => 'reason',

        ]);

        $response->assertStatus(201);
    }

    public function test_the_application_returns_a_leave_request(): void
    {
        $response = $this->post('api/leave-requests', [
            'user_id' => 'user_id',
            'leave_type' => 'leave_type',
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDay(),
            'status' => 'status',
            'reason' => 'reason',
        ]);

        $response->assertJsonStructure([
            'id',
            'user_id',
            'leave_type',
            'status',
            'reason',
            'created_at',
            'updated_at',
        ]);
        $response->assertStatus(201);
    }
    public function test_the_application_returns_a_422_response_when_user_id_is_missing(): void
    {
        $response = $this->post('api/leave-requests', [
            'leave_type' => 'leave_type',
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDay(),
            'status' => 'status',
            'reason' => 'reason',
        ]);

        // dd($response->getContent());

        $response->assertStatus(422);
    }

    public function test_the_database_contains_the_entry()
    {
        $response = $this->post('api/leave-requests', [
            'user_id' => 'user_id',
            'leave_type' => 'leave_type',
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDay(),
            'status' => 'status',
            'reason' => 'reason',
        ]);

        $this->assertDatabaseHas('leave_requests', [
            'user_id' => 'user_id',
            'leave_type' => 'leave_type',
            // 'start_date' => Carbon::now(),
            // 'end_date' => Carbon::now()->addDay(),
            'status' => 'status',
            'reason' => 'reason',
        ]); 
    }
}