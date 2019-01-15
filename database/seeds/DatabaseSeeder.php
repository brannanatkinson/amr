<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stories')->insert([
        	'story_date' => Carbon::now(), 
			'client_id' => 1, 
			'project_id' => 1, 
			'story_url' => 'http://www.tennessean.com/story/opinion/2017/03/18/make-tennessee-more-transparent-not-less/99271644/', 
			'story_headline' => 'Make Tennessee more transparent, not less',
			'story_image' => 'https://www.gannett-cdn.com/-mm-/3b26ca326da18bc15cc23c467e3bdc91c50c6543/c=0-10-2250-1702&r=x404&c=534x401/local/-/media/2017/03/16/TennGroup/Nashville/636252812249884499-siers-sunweek1-rgb.jpg',
			'story_description' => 'this is the story description',
            'media_id' => '1',
			'story_notes' => 'These are some notes',
        ]);

        DB::table('stories')->insert([
            'story_date' => Carbon::now(), 
            'client_id' => 1, 
            'project_id' => 1, 
            'story_url' => 'http://www.tennessean.com/story/opinion/2017/03/18/make-tennessee-more-transparent-not-less/99271644/', 
            'story_headline' => 'Make Tennessee more transparent, not less',
            'story_image' => 'https://www.gannett-cdn.com/-mm-/3b26ca326da18bc15cc23c467e3bdc91c50c6543/c=0-10-2250-1702&r=x404&c=534x401/local/-/media/2017/03/16/TennGroup/Nashville/636252812249884499-siers-sunweek1-rgb.jpg',
            'story_description' => 'this is the story description',
            'media_id' => '1',
            'story_notes' => 'These are some notes',
        ]);

        DB::table('media')->insert([
        	'media_name' => 'The Tennessean', 
        	'media_tld' => 'tennessean.com',
        ]);

        DB::table('clients')->insert([
        	'client_name' => 'OZ Arts Nashville', 
        ]);

        DB::table('projects')->insert([
        	'project_name' => 'Heeseop Yoon', 
        	'project_description' => 'Media coverage for Hide & Seek',
        	'client_id' => 1,
        ]);

        DB::table('projects')->insert([
            'project_name' => 'Intergalatic Nemesis', 
            'project_description' => 'Media coverage for Intergalatic Nemesis',
            'client_id' => 2,
        ]);

        DB::table('users')->insert([
        	'name' => 'Brannan Atkinson', 
        	'email' => 'brannan@amyacommunications.com',
        	'password' => bcrypt('password'),
        ]);

        DB::table('users')->insert([
        	'name' => 'Tim Ozgener', 
        	'email' => 'tim@ozartsnashville.org',
        	'password' => bcrypt('password'),
        ]);

        DB::table('clients_users')->insert([
        	'client_id' => 1, 
        	'user_id' => 2,
        ]);

        DB::table('roles')->insert([
            'name' => 'siteadmin', 
            'display_name' => 'Site Administrator',
            'description' => 'All admin privileges',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('roles')->insert([
            'name' => 'client', 
            'display_name' => 'Client',
            'description' => 'Client privileges',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('role_user')->insert([
            'role_id' => 1, 
            'user_id' => 1,
        ]);

        DB::table('role_user')->insert([
            'role_id' => 2, 
            'user_id' => 2,
        ]);
    }
}
