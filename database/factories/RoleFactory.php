<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Role;

class RoleFactory extends Factory
{
    protected $model = Role::class;

    public function definition()
    {
        return [
            'name' => 'Generated Role ' . fake()->unique()->word(), // Gunakan nama unik
            'description' => 'Generated role for testing',
        ];
    }
}
