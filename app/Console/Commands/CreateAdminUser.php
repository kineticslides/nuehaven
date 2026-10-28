<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateAdminUser extends Command
{
    protected $signature = 'admin:create {email? : Administrator email address} {--name=Administrator : Administrator name}';

    protected $description = 'Create or update a Nue Haven administrator account';

    public function handle(): int
    {
        $email = (string) ($this->argument('email') ?: $this->ask('Administrator email'));
        $password = (string) $this->secret('Password (minimum 12 characters)');
        $confirmation = (string) $this->secret('Confirm password');

        $validator = Validator::make(compact('email', 'password', 'confirmation'), [
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:12', 'same:confirmation'],
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return self::FAILURE;
        }

        User::updateOrCreate(
            ['email' => $email],
            [
                'name' => (string) $this->option('name'),
                'password' => Hash::make($password),
                'is_admin' => true,
            ],
        );

        $this->info("Administrator account ready for {$email}.");

        return self::SUCCESS;
    }
}
