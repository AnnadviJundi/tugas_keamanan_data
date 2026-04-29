<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->sentence(4);

        return [
            'user_id' => User::query()->inRandomOrder()->value('id') ?? User::factory(),
            'title' => $title,
            'slug' => Str::slug($title),
            'category' => fake()->randomElement(['Akademik', 'Beasiswa', 'Kegiatan', 'Layanan Mahasiswa', 'IT']),
            'excerpt' => fake()->sentence(12),
            'content' => fake()->paragraphs(4, true),
            'status' => fake()->randomElement(['draft', 'published']),
            'published_at' => fake()->optional()->dateTimeBetween('-30 days'),
        ];
    }
}
