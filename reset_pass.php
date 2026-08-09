<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$user = App\Models\User::find(2);
$user->password = Illuminate\Support\Facades\Hash::make('password123');
$user->save();
echo "Password reset to password123\n";
