<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class CreateAdmin extends Command
{
    protected $signature = 'admin:create {email?}';

    protected $description = 'Create an administrator account';

    public function handle(): int
    {
        $name = $this->ask('Nama admin');
        $email = $this->argument('email') ?: $this->ask('Email admin');
        $password = $this->secret('Password admin (minimal 12 karakter)');

        $validator = Validator::make(
            compact('name', 'email', 'password'),
            [
                'name' => ['required', 'string', 'max:100'],
                'email' => ['required', 'email', 'max:255', 'unique:users,email'],
                'password' => ['required', 'string', 'min:12'],
            ],
        );

        if ($validator->fails()) {
            $this->error($validator->errors()->first());

            return self::FAILURE;
        }

        $admin = User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);
        $admin->forceFill(['is_admin' => true])->save();

        $this->info('Akun admin berhasil dibuat.');

        return self::SUCCESS;
    }
}
