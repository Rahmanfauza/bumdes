<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$surat = App\Models\Surat::find(1);
if ($surat) {
    $surat->status = 'diajukan';
    $surat->save();
}
echo "Surat status updated to diajukan\n";
