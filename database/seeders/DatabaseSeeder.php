<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed data for tasks
        DB::table('tasks')->insert([
            [
                'title' => 'Task 1',
                'description' => 'Description for Task 1',
                'status' => 'Pending',
                'start_date' => '2024-10-01',
                'end_date' => '2024-10-10',
                'due_date' => '2024-10-05',
                'assigned_to' => 1, // Assuming user ID 1 exists
                'project_id' => 1,  // Assuming project ID 1 exists
                'image' => null,    // Set image value if needed
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Task 2',
                'description' => 'Description for Task 2',
                'status' => 'In Progress',
                'start_date' => '2024-09-20',
                'end_date' => '2024-09-25',
                'due_date' => '2024-09-22',
                'assigned_to' => 2, // Assuming user ID 2 exists
                'project_id' => 2,  // Assuming project ID 2 exists
                'image' => 'sample-image.png', // Example file name for the image
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more tasks as needed
        ]);

        DB::table('projects')->insert([
            [
            'name'=>'Project one',
            'description'=>'Description for one project',
            'start_date'=>'2024-09-20',
            'end_date'=>'2024-09-24',
            'status'=>'Pending',
            'image' => null,    // Set image value if needed
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'name'=>'Project two',
            'description'=>'Description for two project',
            'start_date'=>'2024-09-20',
            'end_date'=>'2024-09-24',
            'status'=>'Pending',
            'image' => null,    // Set image value if needed
            'created_at' => now(),
            'updated_at' => now(),
            ]
        ]);
    }
}
