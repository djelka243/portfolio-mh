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

            return response()->json([
                'success' => true,
                'message' => 'Commande créée avec succès',
                'commande' => $commande,
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
            $this->whatsappService->sendOrderNotificationTemplate($commande);
            
            $this->whatsappService->sendOrderNotificationCustomerTemplate($commande);

        } catch (\Exception $e) {
            Log::error('Erreur notification WhatsApp', [
                'commande' => $commande->numero_commande,
                'error' => $e->getMessage()
            ]);
        }
    }



}