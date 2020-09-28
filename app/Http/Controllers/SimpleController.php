<?php

namespace App\Http\Controllers;

use http\Client\Response;
use Illuminate\Http\Request;
use Faker\Factory as Faker;

class SimpleController extends Controller
{
    private $date;
    protected $faker;
    protected $persons;

    public function __construct()
    {
        $this->date = new \DateTime();
        $this->faker = Faker::create('lt_LT');
    }

    public function get()
    {
        $this->export();
    }

    protected function createPerson()
    {

        return array(
            'username' => (string)$this->faker->userName,
            'password' => (string)$this->faker->password(8, 8),
            'name' => (string)$this->faker->name,
            'company' => (string)$this->faker->company,
            'phone' => (string)$this->faker->e164PhoneNumber,
            'email' => (string)$this->faker->safeEmail,
            'role' => $this->faker->randomElement(array(1, 2, 3, 4)),
            'monitoring_style' => $this->faker->randomElement(array(0, 1, 2, 3, 4)),
            'see_status' => $this->faker->randomElement(array(1, 2, 3, 4)),
            'listen_status' => $this->faker->randomElement(array(0, 1, 2, 4)),
            'eval_status' => $this->faker->randomElement(array(0, 1, 2, 4)),
            'note' => (string)$this->faker->sentence,
            'agent' => (string)$this->faker->unique()->numberBetween(1111, 9999),
            'agent_pass' => (string)$this->faker->randomElement(array('998877', '')),
        );
    }

    public function export()
    {
        $this->persons = array();

        for ($i = 1; $i <= 30; $i++) {
            array_push($this->persons, $this->createPerson());
        }

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=file.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $reviews = $this->persons;
        $columns = array(
            "Prisijungimo vardas",
            "Slaptažodis",
            "Vardas",
            "Įmonė",
            "Telefonas",
            "El. paštas",
            "Rolė",
            "Stebėsenos stilius",
            "Gali matyti",
            "Gali klausytis",
            "Gali vertinti",
            "Pastaba",
            "Prisijungimo vardas (telefono)",
            "Slaptažodis (telefono)"
        );

        $callback = function () use ($reviews, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($reviews as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }
}
