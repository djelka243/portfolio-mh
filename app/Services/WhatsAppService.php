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
     * Envoyer un message simple
     */
    public function sendSimpleMessage($to, $text)
    {
        try {
            // Envoyer le message directement avec WhatsApp API
            $response = $this->whatsapp->sendTextMessage(
                $this->formatPhoneNumber($to),
                $text
            );
            
            Log::info('Message WhatsApp simple envoyé', [
                'to' => $to,
                'message_id' => $response['messages'][0]['id'] ?? 'N/A'
            ]);
            
            return $response;
            
        } catch (\Exception $e) {
            Log::error('Erreur envoi message simple WhatsApp', [
                'error' => $e->getMessage(),
                'to' => $to
            ]);
            return false;
        }
    }

    /**
     * Envoyer un message avec template
     */
    public function sendTemplateMessage($to, $templateName, $parameters = [])
    {
        try {
            // Préparer les composants du template
            $component_header = [];
            $component_body = [];
            $component_buttons = [];
            
            // Organiser les paramètres selon leur type
            foreach ($parameters as $param) {
                $type = $param['type'] ?? 'text';
                
                if ($type === 'header') {
                    $component_header[] = $param;
                } elseif ($type === 'button') {
                    $component_buttons[] = $param;
                } else {
                    $component_body[] = $param;
                }
            }
            
            // Créer le composant
            $components = new Component($component_header, $component_body, $component_buttons);
            
            // Créer et envoyer le template
            $response = $this->whatsapp->sendTemplate(
                $this->formatPhoneNumber($to),
                $templateName,
                'fr', // Langue
                $components
            );
            
            Log::info('Template WhatsApp envoyé', [
                'to' => $to,
                'template' => $templateName,
                'response' => $response->httpStatusCode()
            ]);
            
            return $response;
            
        } catch (\Exception $e) {
            Log::error('Erreur envoi template WhatsApp', [
                'error' => $e->getMessage(),
                'template' => $templateName,
                'to' => $to
            ]);
            return false;
        }
    }

    /**
     * Envoyer un template de notification de commande
     */
    public function sendOrderNotificationTemplate($commande)
    {
        try {
            // Préparer les paramètres pour le template
            $parameters = [
                // Header
                [
                    'type' => 'header',
                    'parameters' => [
                        [
                            'type' => 'text',
                            'text' => $commande->numero_commande
                        ]
                    ]
                ],
                
                // Body parameters
                [
                    'type' => 'body',
                    'parameters' => [
                        [
                            'type' => 'text',
                            'text' => $commande->prenom . ' ' . $commande->nom
                        ],
                        [
                            'type' => 'text',
                            'text' => '$' . number_format($commande->total, 2)
                        ],
                        [
                            'type' => 'text',
                            'text' => date('d/m/Y H:i')
                        ]
                    ]
                ]
            ];
            
            // Nom du template (doit être créé dans WhatsApp Business)
            $templateName = 'order_notification';
            
            return $this->sendTemplateMessage($this->adminNumber, $templateName, $parameters);
            
        } catch (\Exception $e) {
            Log::error('Erreur template notification commande', ['error' => $e->getMessage()]);
            return false;
        }
    }

    /**
     * Envoyer une notification de nouvelle commande (version texte simple)
     */
    public function sendNewOrderNotification($commande)
    {
        try {
            // Formater le message
            $message = $this->formatOrderMessage($commande);
            
            // Envoyer le message texte
            return $this->sendSimpleMessage($this->adminNumber, $message);
            
        } catch (\Exception $e) {
            Log::error('Erreur notification commande WhatsApp', ['error' => $e->getMessage()]);
            return false;
        }
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
        // Nettoyer le numéro
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        // Ajouter l'indicatif si absent
        if (strlen($phone) == 9) {
            $phone = '243' . $phone;
        } elseif (strlen($phone) == 10 && substr($phone, 0, 1) == '0') {
            $phone = '243' . substr($phone, 1);
        }
        
        return $phone;
    }

    /**
     * Tester la connexion
     */
    public function testConnection()
    {
        try {
            $testMessage = "✅ Test WhatsApp API\n\n";
            $testMessage .= "Application: " . config('app.name') . "\n";
            $testMessage .= "Date: " . now()->format('d/m/Y H:i:s') . "\n";
            $testMessage .= "Statut: Connecté avec succès";
            
            return $this->sendSimpleMessage($this->adminNumber, $testMessage);
            
        } catch (\Exception $e) {
            Log::error('Test connexion WhatsApp échoué', ['error' => $e->getMessage()]);
            return false;
        }
    }

    /**
     * Exemple d'utilisation de template avec des boutons
     */
    public function sendWelcomeMessage($to, $customerName)
    {
        try {
            $parameters = [
                // Header
                [
                    'type' => 'header',
                    'parameters' => [
                        [
                            'type' => 'text',
                            'text' => 'Bienvenue!'
                        ]
                    ]
                ],
                
                // Body
                [
                    'type' => 'body',
                    'parameters' => [
                        [
                            'type' => 'text',
                            'text' => $customerName
                        ],
                        [
                            'type' => 'text',
                            'text' => config('app.name')
                        ]
                    ]
                ],
                
                // Boutons
                [
                    'type' => 'button',
                    'sub_type' => 'quick_reply',
                    'index' => 0,
                    'parameters' => [
                        [
                            'type' => 'text',
                            'text' => 'Voir nos produits'
                        ]
                    ]
                ],
                [
                    'type' => 'button',
                    'sub_type' => 'quick_reply',
                    'index' => 1,
                    'parameters' => [
                        [
                            'type' => 'text',
                            'text' => 'Contact support'
                        ]
                    ]
                ]
            ];
            
            return $this->sendTemplateMessage($to, 'welcome_message', $parameters);
            
        } catch (\Exception $e) {
            Log::error('Erreur message de bienvenue', ['error' => $e->getMessage()]);
            return false;
        }
    }
}