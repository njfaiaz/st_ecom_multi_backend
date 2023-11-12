<?php

namespace Database\Seeders;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    public function run()
    {
        $users = User::get();
        $body = ['like', 'view', 'comment', 'shear'];
        foreach ($users as $user) {
            for ($i = 0; $i < 2; $i++) {
                Notification::create([
                    'title' => 'Test Notification Title' . $i,
                    'user_id' => $user->id,
                    'body' => $body[array_rand($body)],
                    'read' => rand(0, 1),
                ]);
            }
        }
    }
}
