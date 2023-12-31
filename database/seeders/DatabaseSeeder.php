<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $user = \App\Models\User::factory()->create([
            'name' => 'Test User',
            'username' => 'testuser',
            'email' => 'test@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
        ]);

        $post = $user->perfil->posts()->create([
            'corpo' => 'Post 1',
        ]);

        $post->comentarios()->create([
            'corpo' => 'Comentário 1',
            'perfil_id' => $user->perfil->id,
        ]);

    }
}
