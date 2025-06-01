<?php

// Jalankan: php artisan make:seeder QuestionAnswerSeeder

// File: database/seeders/QuestionAnswerSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Support\Facades\Hash;

class QuestionAnswerSeeder extends Seeder
{
    public function run(): void
    {
        // Create sample users if they don't exist
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        $users = [];
        for ($i = 1; $i <= 5; $i++) {
            $users[] = User::firstOrCreate(
                ['email' => "user{$i}@example.com"],
                [
                    'name' => "User {$i}",
                    'password' => Hash::make('password'),
                    'role' => 'user',
                ]
            );
        }

        // Sample questions data
        $questionsData = [
            [
                'title' => 'Bagaimana cara menginstall Laravel?',
                'content' => 'Saya baru belajar Laravel dan ingin tahu bagaimana cara menginstall Laravel dengan benar. Apakah perlu menggunakan Composer?',
            ],
            [
                'title' => 'Apa itu Eloquent ORM?',
                'content' => 'Saya sering mendengar tentang Eloquent ORM di Laravel. Bisakah dijelaskan apa itu dan bagaimana cara menggunakannya?',
            ],
            [
                'title' => 'Cara membuat migration di Laravel',
                'content' => 'Bagaimana cara membuat dan menjalankan migration di Laravel? Saya masih bingung dengan konsep migration.',
            ],
            [
                'title' => 'Perbedaan Route dan Controller',
                'content' => 'Apa perbedaan antara Route dan Controller di Laravel? Kapan harus menggunakan yang mana?',
            ],
            [
                'title' => 'Cara menggunakan Middleware',
                'content' => 'Saya ingin membuat autentikasi untuk aplikasi saya. Bagaimana cara menggunakan Middleware di Laravel?',
            ],
            [
                'title' => 'Upload file di Laravel',
                'content' => 'Bagaimana cara upload file seperti gambar di Laravel? Apakah ada package khusus yang direkomendasikan?',
            ],
            [
                'title' => 'Validasi form input',
                'content' => 'Cara terbaik untuk melakukan validasi form input di Laravel itu bagaimana? Apakah bisa custom error message?',
            ],
            [
                'title' => 'Deploy Laravel ke hosting',
                'content' => 'Saya sudah selesai membuat aplikasi Laravel. Bagaimana cara deploy ke shared hosting?',
            ],
        ];

        // Sample answers data
        $answersData = [
            'Untuk menginstall Laravel, Anda perlu Composer terlebih dahulu. Jalankan: composer create-project laravel/laravel nama-project',
            'Eloquent ORM adalah fitur Laravel untuk berinteraksi dengan database menggunakan model PHP yang mudah dipahami.',
            'Gunakan php artisan make:migration nama_migration untuk membuat migration baru, lalu php artisan migrate untuk menjalankannya.',
            'Route mendefinisikan URL endpoint, sedangkan Controller berisi logic bisnis aplikasi. Controller lebih terorganisir untuk logic yang kompleks.',
            'Middleware adalah filter yang berjalan sebelum atau sesudah request. Buat dengan php artisan make:middleware NamaMiddleware.',
            'Laravel memiliki Storage facade untuk upload file. Gunakan $request->file("field")->store("folder") untuk menyimpan file.',
            'Laravel memiliki built-in validation. Gunakan $request->validate([rules]) di controller atau buat Form Request untuk validasi yang kompleks.',
            'Untuk deploy ke shared hosting, upload semua file kecuali folder public. Folder public harus diletakkan di public_html.',
        ];

        // Create questions and answers
        foreach ($questionsData as $index => $questionData) {
            $randomUser = $users[array_rand($users)];
            
            $question = Question::create([
                'title' => $questionData['title'],
                'content' => $questionData['content'],
                'user_id' => $randomUser->id,
            ]);

            // Create 1-3 random answers for each question
            $answerCount = rand(1, 3);
            for ($i = 0; $i < $answerCount; $i++) {
                $randomAnswerUser = $users[array_rand($users)];
                $randomAnswerText = $answersData[array_rand($answersData)];
                
                Answer::create([
                    'content' => $randomAnswerText . " (Jawaban dari " . $randomAnswerUser->name . ")",
                    'question_id' => $question->id,
                    'user_id' => $randomAnswerUser->id,
                ]);
            }
        }

        // Create some questions without answers
        $questionsWithoutAnswers = [
            [
                'title' => 'Laravel vs CodeIgniter?',
                'content' => 'Apa kelebihan dan kekurangan Laravel dibanding CodeIgniter? Mana yang lebih baik untuk pemula?',
            ],
            [
                'title' => 'Error 500 Internal Server Error',
                'content' => 'Website Laravel saya tiba-tiba error 500. Bagaimana cara troubleshooting error ini?',
            ],
        ];

        foreach ($questionsWithoutAnswers as $questionData) {
            $randomUser = $users[array_rand($users)];
            
            Question::create([
                'title' => $questionData['title'],
                'content' => $questionData['content'],
                'user_id' => $randomUser->id,
            ]);
        }
    }
}
