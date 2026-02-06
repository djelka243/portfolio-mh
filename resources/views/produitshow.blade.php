<x-layouts.app :title="__('Détail Produit')" :breadcrumbs="['dashboard' => __('Dashboard'), 'produits.index' => __('Produits'), 'produit' => $produit->name]">
    <div class="max-w-6xl mx-auto">
        <!-- En-tête -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">{{ $produit->name }}</h1>
            <a href="{{ route('produits.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                ← Retour
            </a>
        </div>

        @if (session('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" x-transition
                class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" x-transition
                class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-3 gap-6">
            <div class="col-span-2">
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <h2 class="text-xl font-bold mb-4">Informations du produit</h2>
                    
                    <form id="editForm" method="POST" action="{{ route('produits.update', $produit->id) }}" enctype="multipart/form-data" class="space-y-4 text-black">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Nom</label>
                                <input type="text" name="name" value="{{ $produit->name }}"
                                    class="w-full rounded-lg p-2 border border-gray-300 shadow focus:ring-2 focus:ring-blue-500 " required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Prix</label>
                                <input type="number" name="price" step="0.01" value="{{ $produit->price }}"
                                    class="w-full rounded-lg p-2 border border-gray-300 shadow focus:ring-2 focus:ring-blue-500" required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Description</label>
                            <textarea id="descriptionEditor" name="description" rows="3"
                                class="w-full rounded-lg p-2 border border-gray-300 shadow focus:ring-2 focus:ring-blue-500">{{ $produit->description }}</textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Catégorie</label>
                                <select name="categorie_id"
                                    class="w-full rounded-lg p-2 border border-gray-300 shadow focus:ring-2 focus:ring-blue-500" required>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ $produit->categorie_id === $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Taille</label>
                                <select name="taille"
                                    class="w-full rounded-lg p-2 border border-gray-300 shadow focus:ring-2 focus:ring-blue-500">
                                    <option value="">Aucune</option>
                                    <option value="XS" {{ $produit->taille === 'XS' ? 'selected' : '' }}>XS</option>
                                    <option value="S" {{ $produit->taille === 'S' ? 'selected' : '' }}>S</option>
                                    <option value="M" {{ $produit->taille === 'M' ? 'selected' : '' }}>M</option>
                                    <option value="L" {{ $produit->taille === 'L' ? 'selected' : '' }}>L</option>
                                    <option value="XL" {{ $produit->taille === 'XL' ? 'selected' : '' }}>XL</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Réduction (%)</label>
                            <input type="text" name="reduction" value="{{ $produit->reduction }}"
                                class="w-full rounded-lg p-2 border border-gray-300 shadow focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div class="flex gap-3 pt-4">
                            <button type="submit"
                                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 shadow">
                                Mettre à jour
                            </button>
                            <button type="button" onclick="openDeleteModal()"
                                class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 shadow">
                                Supprimer le produit
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Galerie d'images -->
                <div class="bg-white dark:bg-gray-900 rounded-lg shadow p-6 text-black dark:text-white">
                    <h2 class="text-xl font-bold mb-4">Galerie d'images</h2>

                    @if ($produit->images->count() > 0)
                        <div class="grid grid-cols-4 gap-4 mb-6">
                            @foreach ($produit->images as $image)
                                <div class="relative group">
                                    <img src="{{ asset('storage/' . $image->url) }}" alt="image de {{ $produit->name }}"
                                        class="h-32 w-full object-cover rounded-lg shadow">
                                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition rounded-lg flex items-center justify-center gap-2">
                                        <button onclick="openImageModal('{{ $image->id }}', '{{ $image->description }}')"
                                            class="px-2 py-1 bg-yellow-500 text-white rounded text-xs hover:bg-yellow-600">
                                            Éditer
                                        </button>
                                        <form action="{{ route('images.destroy', $image->id) }}" method="POST" class="inline"
                                            onsubmit="return confirm('Supprimer cette image ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-2 py-1 bg-red-600 text-white rounded text-xs hover:bg-red-700">
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                    <p class="text-xs text-gray-600 mt-1 truncate">{{ $image->description }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 mb-6">Aucune image pour ce produit.</p>
                    @endif

                    <!-- Ajouter une image -->
                    <button onclick="openAddImageModal()"
                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                        + Ajouter une image
                    </button>
                </div>
            </div>

            <!-- Colonne droite: Résumé -->
            <div>
                <div class="bg-white rounded-lg shadow p-6 sticky top-4">
                    <h2 class="text-xl font-bold mb-4">Résumé</h2>

                    <div class="space-y-3">
                        <div>
                            <p class="text-sm text-gray-600">Catégorie</p>
                            <p class="font-semibold">{{ $produit->categorie->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Prix</p>
                            <p class="text-2xl font-bold text-green-600">${{ number_format($produit->price, 2) }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Taille</p>
                            <p class="font-semibold">{{ $produit->taille ?? 'Non spécifiée' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Réduction</p>
                            <p class="font-semibold">{{ $produit->reduction .'%' ?? 'Aucune' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Nombre d'images</p>
                            <p class="font-semibold">{{ $produit->images->count() }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Créé le</p>
                            <p class="font-semibold">{{ $produit->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Modifié le</p>
                            <p class="font-semibold">{{ $produit->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Ajouter image -->
    <div id="addImageModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <div class="bg-white dark:bg-black w-96 p-6 rounded-lg shadow-lg ">
            <h2 class="text-xl font-bold mb-4">Ajouter une image</h2>
            <form action="{{ route('produits.images.store', $produit->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Image</label>
                    <input type="file" name="image" accept="image/*"
                        class="w-full rounded-lg p-2 border border-gray-300" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Description</label>
                    <input type="text" name="description" placeholder="Description de l'image"
                        class="w-full rounded-lg p-2 border border-gray-300">
                </div>
                <div class="flex gap-3">
                    <button type="submit"
                        class="flex-1 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                        Ajouter
                    </button>
                    <button type="button" onclick="closeAddImageModal()"
                        class="flex-1 px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal: Éditer image -->
    <div id="editImageModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <div class="bg-white w-96 p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-bold mb-4">Éditer la description</h2>
            <form id="editImageForm" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Description</label>
                    <input type="text" id="imageDescription" name="description"
                        class="w-full rounded-lg p-2 border border-gray-300">
                </div>
                <div class="flex gap-3">
                    <button type="submit"
                        class="flex-1 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Mettre à jour
                    </button>
                    <button type="button" onclick="closeEditImageModal()"
                        class="flex-1 px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal: Supprimer produit -->
    <div id="deleteModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <div class="bg-white w-96 p-6 rounded-lg shadow-lg text-center">
            <h2 class="text-xl font-bold mb-4 text-red-600">Supprimer le produit</h2>
            <p class="text-gray-600 mb-6">Êtes-vous sûr de vouloir supprimer ce produit ? Cette action est irréversible.</p>
            <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" class="flex gap-3">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="flex-1 px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                    Supprimer
                </button>
                <button type="button" onclick="closeDeleteModal()"
                    class="flex-1 px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                    Annuler
                </button>
            </form>
        </div>
    </div>

    <script>
        function openAddImageModal() {
            document.getElementById('addImageModal').classList.remove('hidden');
            document.getElementById('addImageModal').classList.add('flex');
        }

        function closeAddImageModal() {
            document.getElementById('addImageModal').classList.add('hidden');
            document.getElementById('addImageModal').classList.remove('flex');
        }

        function openImageModal(imageId, description) {
            document.getElementById('imageDescription').value = description;
            document.getElementById('editImageForm').action = '/images/' + imageId;
            document.getElementById('editImageModal').classList.remove('hidden');
            document.getElementById('editImageModal').classList.add('flex');
        }

        function closeEditImageModal() {
            document.getElementById('editImageModal').classList.add('hidden');
            document.getElementById('editImageModal').classList.remove('flex');
        }

        function openDeleteModal() {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteModal').classList.add('flex');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            document.getElementById('deleteModal').classList.remove('flex');
        }

        // Fermer les modals en cliquant sur l'overlay
        document.getElementById('addImageModal')?.addEventListener('click', (e) => {
            if (e.target.id === 'addImageModal') closeAddImageModal();
        });
        document.getElementById('editImageModal')?.addEventListener('click', (e) => {
            if (e.target.id === 'editImageModal') closeEditImageModal();
        });
        document.getElementById('deleteModal')?.addEventListener('click', (e) => {
            if (e.target.id === 'deleteModal') closeDeleteModal();
        });

        // Fermer avec Échap
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeAddImageModal();
                closeEditImageModal();
                closeDeleteModal();
            }
        });

        // Initialiser TinyMCE
        tinymce.init({
            selector: '#descriptionEditor',
            height: 400,
            plugins: ['link', 'image', 'lists', 'code', 'table', 'textcolor', 'fullscreen'],
            toolbar: 'formatselect | bold italic underline strikethrough | forecolor backcolor | bullist numlist | link image table | code fullscreen',
            menubar: 'file edit view insert format table help',
            license_key: 'gpl',
            content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; }',
            skin: 'oxide',
            icons: 'material'
        });
    </script>
   
</x-layouts.app>
