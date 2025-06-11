<?php

namespace App\Console\Commands;

use App\Models\Beneficiaire;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenerateQrTokens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'qr:generate-tokens {--force : Force regeneration of existing tokens}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate QR tokens for beneficiaries who don\'t have them';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $force = $this->option('force');
        
        if ($force) {
            $beneficiaires = Beneficiaire::all();
            $message = 'Regenerating QR tokens for all beneficiaries...';
        } else {
            $beneficiaires = Beneficiaire::whereNull('qr_code_token')->get();
            $message = 'Generating QR tokens for beneficiaries without tokens...';
        }
        
        $this->info($message);
        
        if ($beneficiaires->isEmpty()) {
            $this->info('No beneficiaries need QR token generation.');
            return 0;
        }
        
        $bar = $this->output->createProgressBar($beneficiaires->count());
        $bar->start();
        
        $updated = 0;
        
        foreach ($beneficiaires as $beneficiaire) {
            if ($force || !$beneficiaire->qr_code_token) {
                $beneficiaire->qr_code_token = Str::random(32);
                $beneficiaire->save();
                $updated++;
            }
            $bar->advance();
        }
        
        $bar->finish();
        $this->newLine();
        
        $this->info("Successfully generated QR tokens for {$updated} beneficiaries.");
        
        return 0;
    }
}
