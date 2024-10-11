<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::table('users')->insert([
            [
            'name'=>'Admin',
            'email'=>'admin@gmail.com',
            'password'=>12345678,
            'role'=>'Admin',
            'designation'=>'Laravel Developer',
            'image' => null,    // Set image value if needed
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'name'=>'User',
            'email'=>'user@gmail.com',
            'password'=>12345678,
            'role'=>'User',
            'designation'=>'PHP Developer',
            'image' => null,    // Set image value if needed
            'created_at' => now(),
            'updated_at' => now(),
            ],
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

        DB::table('tasks')->insert([
            [
                'title' => 'Task 1',
                'description' => 'Description for Task 1',
                'status' => 'Pending',
                'start_date' => '2024-10-01',
                'end_date' => '2024-10-10',
                'due_date' => '2024-10-05',
                'assigned_to' => 1, // Assuming user ID 1 exists
                'project_id' => Project::first()->id,  // Assuming project ID 1 exists
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
                'project_id' => Project::first()->id,  // Assuming project ID 2 exists
                'image' => 'sample-image.png', // Example file name for the image
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more tasks as needed
        ]);

       
    }
}
