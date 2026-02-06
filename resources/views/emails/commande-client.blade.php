<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #1f2937; color: white; padding: 20px; text-align: center; }
        .content { background: #f9fafb; padding: 30px; }
        .order-details { background: white; padding: 20px; margin: 20px 0; border-radius: 8px; }
        .product-item { border-bottom: 1px solid #e5e7eb; padding: 10px 0; }
        .total { font-size: 20px; font-weight: bold; text-align: right; margin-top: 20px; }
        .footer { text-align: center; padding: 20px; color: #6b7280; font-size: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Mh Beauty & Creation</h1>
        </div>
        
        <div class="content">
            <h2>Merci pour votre commande !</h2>
            <p>Bonjour {{ $commande->prenom }} {{ $commande->nom }},</p>
            <p>Nous avons bien reçu votre commande. Voici les détails :</p>
            
            <div class="order-details">
                <h3>Commande N° {{ $commande->numero_commande }}</h3>
                <p><strong>Date:</strong> {{ $commande->created_at->format('d/m/Y à H:i') }}</p>
                
                <h4>Adresse de livraison:</h4>
                <p>
                    {{ $commande->adresse }}<br>
                    {{ $commande->ville }} {{ $commande->code_postal }}
                </p>
                
                <h4>Produits commandés:</h4>
                @foreach($produits as $produit)
                <div class="product-item">
                    <strong>{{ $produit['name'] }}</strong><br>
                    Quantité: {{ $produit['quantity'] }} × ${{ number_format($produit['price'], 2) }}
                    = ${{ number_format($produit['price'] * $produit['quantity'], 2) }}
                </div>
                @endforeach
                
                <div class="total">
                    Total: ${{ number_format($commande->total, 2) }}
                </div>
                
                @if($commande->commentaire)
                <div style="margin-top: 20px; padding: 15px; background: #fef3c7; border-radius: 8px;">
                    <strong>Votre commentaire:</strong><br>
                    {{ $commande->commentaire }}
                </div>
                @endif
            </div>
            
            <p>Nous vous tiendrons informé de l'avancement de votre commande.</p>
        </div>
        
        <div class="footer">
            <p>Mh Beauty & Creation - Maison d'habillement contemporaine</p>
            <p>Pour toute question, contactez-nous à contact@mhbeauty.com</p>
        </div>
    </div>
</body>
</html>