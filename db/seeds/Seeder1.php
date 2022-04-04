<?php

use Phinx\Seed\AbstractSeed;

class Seeder1 extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
		$faker = Faker\Factory::create('en_GB');
        $data = [];
        
        for ($i = 0; $i < 5; $i++) {
            $data[] = [
				'studentid' => '2' . $faker->randomNumber(7, true),
                'password'  => sha1($faker->password()),
                'dob'       => $dt = $faker->dateTimeBetween($startDate = '-30 years',
									 $endDate = '-23 years')->format("Y-m-d"),
                'firstname' => $faker->firstName(),
                'lastname'  => $faker->lastName(),
                'house'     => $faker->streetAddress(),
                'town'      => $faker->city(),
                'county'    => $faker->citySuffix(),
                'country'   => 'UK',
                'postcode'  => $faker->postcode(),
				'image'		=> '000',
            ];
        }

        $this->table('student')->insert($data)->saveData();
    }
}
?>
