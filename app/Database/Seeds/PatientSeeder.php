<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;
class PatientSeeder extends Seeder
{
	public function run()
    {
        for ($i = 0; $i < 12; $i++) { //to add 10 patients. Change limit as desired
            $this->db->table('patient')->insert($this->generateClient());
        }
    }

    private function generateClient(): array
    {
      $faker = Factory::create();
      $gender = $faker->randomElement(['L', 'P']);
        return [
            'patient_name' => $faker->name($gender),
            'address' => $faker->address,
            'gender' => $gender,
            'telp' => $faker->phoneNumber
        ];
    }
}
