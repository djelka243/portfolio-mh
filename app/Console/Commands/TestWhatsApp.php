<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\WhatsAppService;

class TestWhatsApp extends Command
{
    protected $signature = 'whatsapp:test {phone?}';
    protected $description = 'Tester l\'envoi de notifications WhatsApp';

    public function handle()
    {
        $whatsappService = new WhatsAppService();
        
        $phone = $this->argument('phone') ?: config('services.whatsapp.admin_number');
        
        $testMessage = "✅ Test WhatsApp Notification\n";
        $testMessage .= "Date: " . now()->format('d/m/Y H:i:s') . "\n";
        $testMessage .= "Application: " . config('app.name') . "\n";
        $testMessage .= "Ceci est un message de test.";
        
        $this->info("Envoi du test à: {$phone}");
        
        try {
            $result = $whatsappService->sendSimpleMessage($phone, $testMessage);
            
            if ($result) {
                $this->info('✅ Message envoyé avec succès!');
            } else {
                $this->error('❌ Échec de l\'envoi du message');
            }
            
        } catch (\Exception $e) {
            $this->error('Erreur: ' . $e->getMessage());
        }
    }
}