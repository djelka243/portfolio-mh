<x-layouts.app :title="__('Détail Catégorie')" :breadcrumbs="['dashboard' => __('Dashboard'), 'categories.index' => __('Catégories'), 'categorie' => $categorie->name]">
    <div class="max-w-4xl mx-auto">
        <!-- En-tête -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">{{ $categorie->name }}</h1>
            <a href="{{ route('categories.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
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

        <div class="grid grid-cols-1 gap-6">
            <!-- Informations de la catégorie -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold mb-4">Informations de la catégorie</h2>
                
                <form id="editForm" method="POST" action="{{ route('categories.update', $categorie->id) }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Nom</label>
                        <input type="text" name="name" value="{{ $categorie->name }}"
                            class="w-full rounded-lg p-2 border border-gray-300 shadow focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Description</label>
                        <textarea name="description" rows="4"
                            class="w-full rounded-lg p-2 border border-gray-300 shadow focus:ring-2 focus:ring-blue-500">{{ $categorie->description }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Image</label>
                        @if ($categorie->image)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $categorie->image) }}" alt="image de {{ $categorie->name }}"
                                    class="h-40 w-40 object-cover rounded-lg shadow">
                            </div>
                        @endif
                        <input type="file" name="image" accept="image/*"
                            class="w-full rounded-lg p-2 border border-gray-300 shadow focus:ring-2 focus:ring-blue-500">
                        <p class="text-xs text-gray-500 mt-1">Laissez vide pour garder l'image actuelle</p>
                    </div>

                    <div class="flex gap-3 pt-4">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 shadow">
                            Mettre à jour
                        </button>
                        <button type="button" onclick="openDeleteModal()"
                            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 shadow">
                            Supprimer la catégorie
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal: Supprimer catégorie -->
    <div id="deleteModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <div class="bg-white w-96 p-6 rounded-lg shadow-lg text-center">
            <h2 class="text-xl font-bold mb-4 text-red-600">Supprimer la catégorie</h2>
            <p class="text-gray-600 mb-6">Êtes-vous sûr de vouloir supprimer cette catégorie ? Cette action est irréversible.</p>
            <form action="{{ route('categories.destroy', $categorie->id) }}" method="POST" class="flex gap-3">
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
        function openDeleteModal() {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteModal').classList.add('flex');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            document.getElementById('deleteModal').classList.remove('flex');
        }

        // Fermer le modal en cliquant sur l'overlay
        document.getElementById('deleteModal')?.addEventListener('click', (e) => {
            if (e.target.id === 'deleteModal') closeDeleteModal();
        });

        // Fermer avec Échap
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeDeleteModal();
            }
        });
    </script>
</x-layouts.app>
