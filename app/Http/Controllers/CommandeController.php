<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Mail\CommandeClient;
use App\Mail\CommandeAdmin;
use App\Services\WhatsAppService;

class CommandeController extends Controller
{
    protected $whatsappService;

    public function __construct()
    {
        $this->whatsappService = new WhatsAppService();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string',
            'ville' => 'required|string|max:255',
            'code_postal' => 'nullable|string|max:10',
            'commentaire' => 'nullable|string',
            'total' => 'required|numeric|min:0',
            'produits' => 'required|json'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Créer la commande
            $commande = Commande::create([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'adresse' => $request->adresse,
                'ville' => $request->ville,
                'code_postal' => $request->code_postal,
                'commentaire' => $request->commentaire,
                'total' => $request->total,
                'produits' => json_decode($request->produits, true)
            ]);

            // 1. Envoyer les emails
            $this->sendEmails($commande);

            // 2. Envoyer notification WhatsApp à l'admin (en arrière-plan)
            $this->sendWhatsAppNotification($commande);

            // Générer le lien WhatsApp pour le client
            $whatsappLink = $this->generateWhatsAppLink($commande);

            return response()->json([
                'success' => true,
                'message' => 'Commande créée avec succès',
                'commande' => $commande,
                'whatsappLink' => $whatsappLink
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur création commande', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création de la commande'
            ], 500);
        }
    }

    /**
     * Envoyer les emails
     */
    private function sendEmails($commande)
    {
        try {
            // Email au client
            Mail::to($commande->email)->send(new CommandeClient($commande));
            
            // Email à l'admin
            $adminEmail = config('mail.admin_email', 'admin@example.com');
            if ($adminEmail) {
                Mail::to($adminEmail)->send(new CommandeAdmin($commande));
            }
            
            Log::info('Emails envoyés avec succès', [
                'commande' => $commande->numero_commande
            ]);
            
        } catch (\Exception $e) {
            Log::error('Erreur envoi emails', [
                'commande' => $commande->numero_commande,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Envoyer notification WhatsApp
     */
    private function sendWhatsAppNotification($commande)
    {
        try {
            // Envoyer immédiatement
            $this->whatsappService->sendNewOrderNotification($commande);
            
            // Optionnel: Programmer un rappel pour plus tard
            $this->scheduleWhatsAppReminder($commande);
            
        } catch (\Exception $e) {
            Log::error('Erreur notification WhatsApp', [
                'commande' => $commande->numero_commande,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Programmer un rappel WhatsApp
     */
    private function scheduleWhatsAppReminder($commande)
    {
        // Programmer un rappel dans 1 heure
        dispatch(function () use ($commande) {
            try {
                $reminderMessage = "📋 Rappel - Commande #{$commande->numero_commande}\n";
                $reminderMessage .= "Client: {$commande->prenom} {$commande->nom}\n";
                $reminderMessage .= "Total: $" . number_format($commande->total, 2) . "\n";
                $reminderMessage .= "Statut: En attente de traitement";
                
                $this->whatsappService->sendSimpleMessage(
                    config('services.whatsapp.admin_number'),
                    $reminderMessage
                );
                
            } catch (\Exception $e) {
                Log::error('Erreur rappel WhatsApp', ['error' => $e->getMessage()]);
            }
        })->delay(now()->addHour());
    }

    /**
     * Générer le lien WhatsApp pour le client
     */
    private function generateWhatsAppLink($commande)
    {
        $message = "🛍️ *Merci pour votre commande*\n\n";
        $message .= "*Référence:* " . $commande->numero_commande . "\n\n";
        
        $message .= "*Détail de votre commande:*\n";
        
        $produits = $commande->produits;
        if (is_string($produits)) {
            $produits = json_decode($produits, true);
        }
        
        if (is_array($produits)) {
            foreach ($produits as $produit) {
                $message .= "• " . $produit['name'] . " x" . $produit['quantity'] . " - $" . number_format($produit['price'] * $produit['quantity'], 2) . "\n";
            }
        }
        
        $message .= "\n*Total:* $" . number_format($commande->total, 2) . "\n";
        $message .= "*Livraison:* Gratuite\n";
        
        if ($commande->commentaire) {
            $message .= "\n*Commentaire:* " . $commande->commentaire;
        }
        
        // Numéro de l'entreprise
        $whatsappNumber = config('services.whatsapp.number', '243123456789');
        
        return "https://wa.me/" . $whatsappNumber . "?text=" . urlencode($message);
    }

    /**
     * Envoyer SMS de confirmation au client
     */
    /*private function sendSMSConfirmation($commande)
    {
        try {
            // Utiliser un service SMS (ex: Twilio, Vonage, etc.)
            $smsService = new SMSService();
            
            $message = "Merci pour votre commande #{$commande->numero_commande}. ";
            $message .= "Nous vous contacterons bientôt pour la livraison. ";
            $message .= "Total: $" . number_format($commande->total, 2);
            
            $smsService->send($commande->telephone, $message);
            
        } catch (\Exception $e) {
            Log::warning('Erreur envoi SMS', ['error' => $e->getMessage()]);
        }
    }*/

}