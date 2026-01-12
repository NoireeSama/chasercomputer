<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pesanan;
use App\Models\StatusPesanan;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class DeleteCompletedPesanan extends Command
{
    protected $signature = 'pesanan:purge-completed';

    protected $description = 'Delete completed orders (Selesai) older than 10 minutes';

    public function handle()
    {
        $status = StatusPesanan::where('nama', 'Selesai')->first();
        if (! $status) {
            $this->info('Status "Selesai" not found; nothing to purge.');
            return 0;
        }

        $threshold = Carbon::now()->subMinutes(10);

        $query = Pesanan::where('status_id', $status->id)
            ->where('updated_at', '<=', $threshold);

        $count = $query->count();

        if ($count === 0) {
            $this->info('No completed orders older than 10 minutes.');
            return 0;
        }

        $query->chunkById(100, function ($items) {
            foreach ($items as $item) {
                $item->delete();
            }
        });

        $this->info("Deleted {$count} completed orders older than 10 minutes.");
        Log::info("pesanan:purge-completed - Deleted {$count} completed orders older than 10 minutes.");

        return 0;
    }
}
