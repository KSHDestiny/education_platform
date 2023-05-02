<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $data = [
            'name' => "Justin",
            'role' => "founder",
            'email' => "justin@gmail.com",
            'password' => Hash::make("justin123"),
            'description' => "Justin, Professor of Computer Science, is the founding director of Education Platform. Justin transferred to emeritus status on July 1, 2021 after 28 years on the Princeton University faculty of computer science and the Princeton School of Public and International Affairs (SPIA). Justin is currently the co-founder and chief scientist of Offchain Labs, Inc. Justin founded CITP and led it for 13 years (apart from two federal government posts) before handing off his leadership role.",
            'gender' => "male",
            'education' => "PhD in Computer Science"
        ];
        User::create($data);
    }
}
