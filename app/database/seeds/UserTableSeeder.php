<?php

class UserTableSeeder extends Seeder {

	public function run()
	{
		 DB::table('users')->truncate();

		$user = array(
            'email'      => 'simon.dann@gmail.com',
            'password'   => 'password',
            'first_name' => 'Simon',
            'last_name'  => 'Dann',
		);

		// Uncomment the below to run the seeder
		DB::table('users')->insert($user);
	}

}
