<?php

namespace Database\Factories;

use App\Models\TimeTable;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

class TimeTableFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TimeTable::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'trainDate' => $this->faker->date,
            'trainNo' => $this->faker->numberBetween($min = 100, $max = 9000),
            'originStationId' => Arr::random(["0990", "1000", "1010", "1020", "1030", "1035", "1040", "1043", "1047", "1050", "1060", "1070"]),
            'originStationName' => Arr::random(["南港", "台北", "板橋", "桃園", "新竹", "苗栗", "台中", "彰化", "雲林", "嘉義", "台南", "左營"]),
            'destinationStationId' => Arr::random(["0990", "1000", "1010", "1020", "1030", "1035", "1040", "1043", "1047", "1050", "1060", "1070"]),
            'destinationStationName' => Arr::random(["南港", "台北", "板橋", "桃園", "新竹", "苗栗", "台中", "彰化", "雲林", "嘉義", "台南", "左營"]),
            'departureTime' => '06:00',
            'arrivalTime' => '08:00',
            'duration' => '2:00',
            'type' => $this->faker->randomElement(['business', 'economic']),
            'amount' => $this->faker->randomDigit(),
        ];
    }
}
