<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'trainNo' => $this->faker->numberBetween($min = 100, $max = 9000),
            'originStationName' => $this->faker->randomElement(["南港", "台北", "板橋", "桃園", "新竹", "苗栗", "台中", "彰化", "雲林", "嘉義", "台南", "左營"]),
            'destinationStationName' => $this->faker->randomElement(["南港", "台北", "板橋", "桃園", "新竹", "苗栗", "台中", "彰化", "雲林", "嘉義", "台南", "左營"]),
            'departureTime' => '06:00',
            'arrivalTime' => '08:00',
            'fare' => $this->faker->numberBetween(40, 3000),
            'amount' => $this->faker->randomDigit(),
            'user_id' => User::all()->random()->id,
            'trainDate' => $this->faker->date,
            'paid' => $this->faker->numberBetween(0, 1)
        ];
    }
}
