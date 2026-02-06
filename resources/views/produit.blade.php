<x-layouts.app :title="__('Dashboard - produits')" :breadcrumbs="['dashboard' => __('Dashboard'), 'produits.index' => __('produits')]">
    <div class="max-w-5xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Gestion Produit</h1>

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

        <div class="mb-6">
            <button id="syncBtn" onclick="doSync()" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                + Synchroniser les produits
            </button>
        </div>

        <!-- Loader -->
        <div id="syncLoader" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
            <div class="bg-white p-8 rounded-lg shadow-lg text-center">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-red-600 mx-auto mb-4"></div>
                <p class="text-gray-700 font-medium">Synchronisation en cours...</p>
            </div>
        </div>


        <div class="shadow rounded p-6 overflow-x-auto">
            <table class="w-full border-collapse text-sm">
                <thead>
                    <tr>
                        <th class="px-2 py-1 border">ID</th>
                        <th class="px-2 py-1 border">Nom</th>
                        <th class="px-2 py-1 border">Prix</th>
                        <th class="px-2 py-1 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produits as $prod)
                        <tr>
                            <td class="border px-2 py-1 text-center">
                                {{ ($produits->currentPage() - 1) * $produits->perPage() + $loop->iteration }}
                            </td>
                            <td class="border px-2 py-1">{{ $prod->name }}</td>
                            <td class="border px-2 py-1">{{ $prod->price }}</td>
    
                            <td class="border px-2 py-1 flex gap-1 justify-center">
                                <!-- Détails -->
                                <a href="{{ route('produits.show', $prod->id) }}"
                                    class="bg-gray-600 text-white rounded hover:bg-blue-600 font-extrabold py-2 px-6">
                                    Afficher
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-gray-500 py-4">Aucune produit trouvée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $produits->links() }}
        </div>
    </div>


    <div id="editModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <div id="editModalCard"
            class="bg-white w-96 p-6 rounded-2xl shadow-2xl transform transition-all duration-200 opacity-0 scale-95">
            <div class="flex items-center gap-2 mb-4">
                <svg class="w-6 h-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 17h2m-6 4h10a2 2 0 002-2v-4a2 2 0 00-2-2h-2V7a2 2 0 00-2-2H9a2 2 0 00-2 2v6H5a2 2 0 00-2 2v4a2 2 0 002 2z" />
                </svg>
                <h2 class="text-xl font-bold text-gray-800">Modifier le produits</h2>
            </div>

            <form id="editForme" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-medium text-gray-600">Nom du produits</label>
                    <input type="text" id="Nom" name="name"
                        class="w-full rounded-lg p-2 border-1 border-gray-900 shadow-xl hover:shadow-blue-800 text-black"
                        required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600">description</label>
                    <input type="text" id="description" name="description"
                        class="w-full rounded-lg p-2 border-1 border-gray-900 shadow-xl hover:shadow-blue-800 text-black"
                        required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600">Prix unitaire</label>
                    <input type="text" id="price" name="price"
                        class="w-full rounded-lg p-2 border-1 border-gray-900 shadow-xl hover:shadow-blue-800 text-black"
                        required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600">Image</label>
                    <input type="file" id="image" name="image"
                        class="w-full rounded-lg p-2 border-1 border-gray-900 shadow-xl hover:shadow-blue-800 text-black">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600">Taille</label>
                    <select id="taille" name="taille"
                        class="w-full rounded-lg p-2 border-1 border-gray-900 shadow-xl hover:shadow-blue-800 text-black">
                        <option value="">Sélectionnez une taille</option>
                        <option value="XS">XS</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600">Réduction</label>
                    <input type="text" id="reduction" name="reduction"
                        class="w-full rounded-lg p-2 border-1 border-gray-900 shadow-xl hover:shadow-blue-800 text-black">
                </div>
                @foreach ($categories as $categorie)
                    <div>
                        <input type="hidden" id="categorie_{{ $categorie->id }}" name="categorie_id"
                            value="{{ $categorie->id }}"
                            class="mr-2 leading-tight">
                    </div>
                @endforeach
                <div class="flex justify-end gap-3 pt-4">
                    <button type="button" onclick="closeEditModal()"
                        class="px-4 py-2 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200">
                        Annuler
                    </button>
                    <button type="submit"
                        class="px-4 py-2 rounded-lg bg-yellow-500 text-white hover:bg-yellow-600 shadow">
                        Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const showModal = (overlayId, cardId) => {
            const overlay = document.getElementById(overlayId);
            const card = document.getElementById(cardId);
            overlay.classList.remove('hidden');
            overlay.classList.add('flex');
            requestAnimationFrame(() => {
                card.classList.remove('opacity-0', 'scale-95');
                card.classList.add('opacity-100', 'scale-100');
            });
        };

        const hideModal = (overlayId, cardId) => {
            const overlay = document.getElementById(overlayId);
            const card = document.getElementById(cardId);
            card.classList.add('opacity-0', 'scale-95');
            card.classList.remove('opacity-100', 'scale-100');
            setTimeout(() => {
                overlay.classList.add('hidden');
                overlay.classList.remove('flex');
            }, 200);
        };


        function doSync() {
            const loader = document.getElementById('syncLoader');
            const syncBtn = document.getElementById('syncBtn');
            
            loader.classList.remove('hidden');
            syncBtn.disabled = true;

            fetch("{{ route('produits.sync') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    loader.classList.add('hidden');
                    syncBtn.disabled = false;
                    
                    if (data.success) {
                        alert(data.message);
                        location.reload();
                    } else {
                        alert('Erreur : ' + data.message);
                        console.error('Erreur API:', data.message);
                    }
                })
                .catch(error => {
                    loader.classList.add('hidden');
                    syncBtn.disabled = false;
                    console.error('Erreur réseau:', error);
                    alert('Erreur de connexion. Vérifiez que l\'API est accessible.');
                });
        }


        function openAddModal() {
            showModal('addModal', 'addModalCard');
        }

        function closeAddModal() {
            hideModal('addModal', 'addModalCard');
        }

        function openEditModal(id, name, description, price, taille,reduction ) {
            const form = document.getElementById('editForme');
            form.action = "{{ url('produits') }}/" + id;
            document.getElementById('Nom').value = name ?? '';
            document.getElementById('description').value = description ?? '';
            document.getElementById('price').value = price ?? '';
            document.getElementById('taille').value = taille ?? '';
            document.getElementById('reduction').value = reduction ?? '';
            showModal('editModal', 'editModalCard');
        }

        function closeEditModal() {
            hideModal('editModal', 'editModalCard');
        }

        // Fermer en cliquant sur l’overlay
        document.getElementById('addModal').addEventListener('click', (e) => {
            if (e.target.id === 'addModal') closeAddModal();
        });
        document.getElementById('editModal').addEventListener('click', (e) => {
            if (e.target.id === 'editModal') closeEditModal();
        });

        // Fermer avec Échap
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeAddModal();
                closeEditModal();
            }
        });
    </script>


</x-layouts.app>
