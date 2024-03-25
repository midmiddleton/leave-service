<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\leaveRequest>
 */
class LeaveRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('now', '+1 year');
        $endDate = $this->faker->dateTimeInInterval($startDate, '+1 month');

        $leaveTypes = [
            'personal',
            'sick',
            'vacation',
            'bereavement'
        ];
        $statuses = [
            'pending',
            'approved',
            'denied'
        ];
        $users = [
            'Lez',
            'Norton',
            'Quinton',
            'Sassy',
            'Donny',
            'Mike',
            'Clarence',
            'Warning Guy',
            'King Laranox',
            'Choomas'
        ];

        return [
            'id' => $this->faker->uuid(),
            'user_id' => $users[array_rand($users)],
            'leave_type' => $leaveTypes[array_rand($leaveTypes)],
            'start_date' => $startDate->format('Y-m-d H:i:s'),
            'end_date' => $endDate->format('Y-m-d H:i:s'),
            'status' => $statuses[array_rand($statuses)],
            'reason' => substr($this->faker->sentence(), 0, 50),
        ];
    }
}
