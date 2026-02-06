<x-layouts.app :title="__('Categorie')" :breadcrumbs="['dashboard' => __('Dashboard'), 'categories.index' => __('Categorie')]">
    <div class="max-w-5xl mx-auto py-2">
        <h1 class="text-2xl font-bold mb-6">Gestion Catégorie</h1>

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
            <button onclick="doSync()" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                + Synchroniser les produits
            </button>
        </div>


        <div class="shadow rounded p-6 overflow-x-auto">
            <h2 class="text-lg font-semibold mb-4">categories existantes</h2>
            <table class="w-full border-collapse text-sm">
                <thead>
                    <tr>
                        <th class="px-2 py-1 border">ID</th>
                        <th class="px-2 py-1 border">Nom</th>
                        <th class="px-2 py-1 border">Description</th>
                        <th class="px-2 py-1 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $cour)
                        <tr>
                            <td class="border px-2 py-1 text-center">
                                {{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }}
                            </td>
                            <td class="border px-2 py-1">{{ $cour->name }}</td>
                            <td class="border px-2 py-1">{{ $cour->description }}</td>
                            <td class="border px-2 py-1 flex gap-1 justify-center">
                                <!-- Afficher -->
                                <a href="{{ route('categories.show', $cour->id) }}"
                                    class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-xs inline-block">
                                    Afficher
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-gray-500 py-4">Aucune categorie trouvée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $categories->links() }}
        </div>
    </div>
    <div id="addModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <div id="addModalCard"
            class="bg-white w-96 p-6 rounded-2xl shadow-2xl transform transition-all duration-200 opacity-0 scale-95">
            <div class="flex items-center gap-2 mb-4">
                <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <h2 class="text-xl font-bold text-gray-800">Ajouter un categorie</h2>
            </div>

            <form action="{{ route('categories.store') }}" method="POST" class="space-y-4"
                enctype="multipart/form-data">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-600">Nom du categorie</label>
                    <input type="text" name="name"
                        class="w-full rounded-lg p-2 border-1 border-gray-900 shadow-xl hover:shadow-blue-800 text-black"
                        required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600">Description</label>
                    <input type="text" name="description"
                        class="w-full rounded-lg p-2 border-1 border-gray-900 shadow-xl hover:shadow-blue-800 text-black"
                        required>
                </div>


                <div class="flex justify-end gap-3 pt-4">
                    <button type="button" onclick="closeAddModal()"
                        class="px-4 py-2 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200">
                        Annuler
                    </button>
                    <button type="submit" class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 shadow">
                        Ajouter
                    </button>
                </div>
            </form>
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
                <h2 class="text-xl font-bold text-gray-800">Modifier la categorie</h2>
            </div>

            <form id="editForme" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-medium text-gray-600">Nom du categorie</label>
                    <input type="text" id="name" name="name"
                        class="w-full rounded-lg p-2 border-1 border-gray-900 shadow-xl hover:shadow-blue-800 text-black"
                        required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600">Description</label>
                    <input type="text" id="description" name="description"
                        class="w-full rounded-lg p-2 border-1 border-gray-900 shadow-xl hover:shadow-blue-800 text-black"
                        required>
                </div>


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
        function doSync() {
            fetch("{{ route('categories.sync') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                })
                .then(async response => {
                    if (!response.ok) {
                        const error = await response.text();
                        throw error;
                    }
                    return response.json();
                })
                .then(data => {
                    alert(data.message);
                    location.reload();
                })
                .catch(error => {
                    console.error('Erreur Laravel:', error);
                    alert('Erreur lors de la synchronisation (voir console)');
                });
        }
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


        function openAddModal() {
            showModal('addModal', 'addModalCard');
        }

        function closeAddModal() {
            hideModal('addModal', 'addModalCard');
        }

        function openEditModal(id, name, description) {
            const form = document.getElementById('editForme');
            form.action = "{{ url('categories') }}/" + id;
            document.getElementById('name').value = name ?? '';
            document.getElementById('description').value = description ?? '';
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
