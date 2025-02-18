<?php

namespace Database\Seeders;

use App\Models\Employer;
use App\Models\Job;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Storage;
use Vite;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $file_name = 'large-animal.png';
        $file_name2 = 'company.png';
        copy(Vite::asset("resources/images/".$file_name) , Storage::path("logos/".$file_name));
        copy(Vite::asset("resources/images/".$file_name2) , Storage::path("logos/".$file_name2));
        $tags = Tag::factory(3)->create();
        $employer1 = Employer::factory()->create([
            'name'=> 'USAID',
            'logo'=> 'logos/'.$file_name
        ]);
        $employer2 = Employer::factory()->create([
            'name'=> 'SpaceX',
            'logo'=> 'logos/'.$file_name2
        ]);
        Job::factory(20)->hasAttached($tags)->create(new Sequence([
            'featured' => false,
            'schedule' => 'Part Time',
            'employer_id'=> $employer1->id,
        ], [
            'featured'=> true,
            'schedule'=> 'Full Time',
            'employer_id'=> $employer2->id,
        ]));
    }
}
