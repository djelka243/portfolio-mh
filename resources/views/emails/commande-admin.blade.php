<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #dc2626; color: white; padding: 20px; text-align: center; }
        .content { background: #f9fafb; padding: 30px; }
        .order-details { background: white; padding: 20px; margin: 20px 0; border-radius: 8px; }
        .product-item { border-bottom: 1px solid #e5e7eb; padding: 10px 0; }
        .total { font-size: 20px; font-weight: bold; text-align: right; margin-top: 20px; }
        .alert { background: #fef3c7; padding: 15px; border-radius: 8px; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🛍️ Nouvelle Commande</h1>
        </div>
        
        <div class="content">
            <div class="alert">
                <strong>⚠️ Action requise:</strong> Une nouvelle commande a été passée et nécessite votre attention.
            </div>
            
            <div class="order-details">
                <h3>Commande N° {{ $commande->numero_commande }}</h3>
                <p><strong>Date:</strong> {{ $commande->created_at->format('d/m/Y à H:i') }}</p>
                
                <h4>Informations client:</h4>
                <p>
                    <strong>Nom:</strong> {{ $commande->prenom }} {{ $commande->nom }}<br>
                    <strong>Email:</strong> {{ $commande->email }}<br>
                    <strong>Téléphone:</strong> {{ $commande->telephone }}
                </p>
                
                <h4>Adresse de livraison:</h4>
                <p>
                    {{ $commande->adresse }}<br>
                    {{ $commande->ville }} {{ $commande->code_postal }}
                </p>
                
                <h4>Produits commandés:</h4>
                @foreach($produits as $produit)
                <div class="product-item">
                    <strong>{{ $produit['name'] }}</strong> (SKU: {{ $produit['id'] }})<br>
                    Quantité: {{ $produit['quantity'] }} × ${{ number_format($produit['price'], 2) }}
                    = ${{ number_format($produit['price'] * $produit['quantity'], 2) }}
                </div>
                @endforeach
                
                <div class="total">
                    Total: ${{ number_format($commande->total, 2) }}
                </div>
                
                @if($commande->commentaire)
                <div style="margin-top: 20px; padding: 15px; background: #e0e7ff; border-radius: 8px;">
                    <strong>Commentaire du client:</strong><br>
                    {{ $commande->commentaire }}
                </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>