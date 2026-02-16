<?php

namespace App\Services;

use Netflie\WhatsAppCloudApi\WhatsAppCloudApi;
use Netflie\WhatsAppCloudApi\Message\TextMessage;
use Netflie\WhatsAppCloudApi\Message\Template\Template;
use Netflie\WhatsAppCloudApi\Message\Template\Component;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    private $whatsapp;
    private $adminNumber;

    public function __construct()
    {
        $this->adminNumber = config('services.whatsapp.admin_number');
        
        // Configuration WhatsApp
        $this->whatsapp = new WhatsAppCloudApi([
            'from_phone_number_id' => config('services.whatsapp.phone_number_id'),
            'access_token' => config('services.whatsapp.access_token'),
        ]);
    }

    /**
     * Envoyer un template de notification de commande
     */
  public function sendOrderNotificationTemplate($commande)
{
    try {

        $bodyParameters = [
           ['type' => 'text', 'text' => $this->cleanParam($commande->prenom ?? ' ')],       // {{1}}
            ['type' => 'text', 'text' => $this->cleanParam($commande->nom ?? ' ')],          // {{2}}
            ['type' => 'text', 'text' => $this->cleanParam($commande->email ?? ' ')],        // {{3}}
            ['type' => 'text', 'text' => $this->cleanParam($commande->telephone ?? ' ')],    // {{4}}
            ['type' => 'text', 'text' => $this->cleanParam($commande->adresse ?? ' ')],      // {{5}}
            ['type' => 'text', 'text' => $this->cleanParam($commande->ville ?? ' ')],        // {{6}}
            ['type' => 'text', 'text' => $this->cleanParam($commande->code_postal ?? ' ')],  // {{7}}
            ['type' => 'text', 'text' => $this->cleanParam($this->formatProduitsList($commande))], // {{8}} - CRITIQUE
            ['type' => 'text', 'text' => (string)number_format($commande->total, 2) . ' $'], // {{9}}
            ['type' => 'text', 'text' => $this->cleanParam($commande->commentaire ?? 'Aucun')], // {{10}}
        ];

        $components = new Component([], $bodyParameters, []);

        $response = $this->whatsapp->sendTemplate(
            $this->formatPhoneNumber($this->adminNumber),
            'commande_client',
            'fr', 
            $components
        );

        Log::info("WhatsApp envoyé via template commande_client", ['status' => $response->httpStatusCode()]);
        return $response;

    } catch (\Exception $e) {
        Log::error('Erreur WhatsApp #132018 : Paramètres invalides', [
            'error' => $e->getMessage(),
            'check_params_count' => count($bodyParameters),
            'first_param' => $bodyParameters[0]['text'] ?? 'vide'
        ]);
        return false;
    }
}


    public function sendOrderNotificationCustomerTemplate($commande)
    {
        try {
            $bodyParameters = [
                ['type' => 'text', 'text' => $commande->prenom],        
                ['type' => 'text', 'text' => $commande->nom],        
            ];

            $components = new Component([], $bodyParameters, []);

            $response = $this->whatsapp->sendTemplate(
                $this->formatPhoneNumber($commande->telephone),
                'confirmation_commande',  
                'fr',  
                $components
            );

            Log::info('Notification WhatsApp confirmation_commande envoyée', ['id' => $commande->id]);
            return $response;

        } catch (\Exception $e) {
            Log::error('Erreur template confirmation_commande: ' . $e->getMessage());
            return false;
        }
    }



    private function cleanParam($text)
{
    // Remplace les retours à la ligne et tabulations par des espaces
    $text = str_replace(["\r", "\n", "\t"], ' ', (string)$text);
    // Remplace les espaces multiples (plus de 4) par un seul espace (exigé par l'erreur 132018)
    $text = preg_replace('/\s+/', ' ', $text);
    
    return trim($text);
}


    private function formatProduitsList($commande)
{
    $produits = $commande->produits;
    if (is_string($produits)) {
        $produits = json_decode($produits, true);
    }

    $items = [];
    if (is_array($produits)) {
        foreach ($produits as $p) {
            $items[] = "{$p['name']} (x{$p['quantity']})";
        }
        // On joint avec des virgules au lieu de retours à la ligne \n
        return implode(', ', $items); 
    }
    
    return "Aucun produit";
}
    /**
     * Formater le message de commande
     */
    private function formatOrderMessage($commande)
    {
        $message = "🛍️ *NOUVELLE COMMANDE*\n\n";
        
        $message .= "*Référence:* {$commande->numero_commande}\n";
        $message .= "*Date:* " . $commande->created_at->format('d/m/Y H:i') . "\n\n";
        
        $message .= "*INFORMATIONS CLIENT*\n";
        $message .= "• Nom: {$commande->prenom} {$commande->nom}\n";
        $message .= "• Téléphone: {$commande->telephone}\n";
        $message .= "• Email: {$commande->email}\n";
        $message .= "• Adresse: {$commande->adresse}\n";
        $message .= "• Ville: {$commande->ville}\n\n";
        
        $message .= "*DÉTAIL DE LA COMMANDE*\n";
        
        $produits = $commande->produits;
        if (is_string($produits)) {
            $produits = json_decode($produits, true);
        }
        
        if (is_array($produits)) {
            foreach ($produits as $produit) {
                $message .= "• {$produit['name']} x{$produit['quantity']} ";
                $message .= "- $" . number_format($produit['price'] * $produit['quantity'], 2) . "\n";
            }
        }
        
        $message .= "\n*SOUS-TOTAL:* $" . number_format($commande->total, 2) . "\n";
        $message .= "*LIVRAISON:* Gratuite\n";
        $message .= "*TOTAL:* $" . number_format($commande->total, 2) . "\n";
        
        if ($commande->commentaire) {
            $message .= "\n*COMMENTAIRE:*\n{$commande->commentaire}\n";
        }
        
        $message .= "\n---\n" . config('app.name');
        
        return $message;
    }

    /**
     * Formater le numéro de téléphone
     */
    private function formatPhoneNumber($phone)
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        if (str_starts_with($phone, '0')) {
            $phone = '243' . substr($phone, 1);
        }
        
        if (strlen($phone) == 9) {
            $phone = '243' . $phone;
        }

        return $phone;
    }





}