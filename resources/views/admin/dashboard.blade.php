<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Tableau de bord Administrateur</h2>
    </x-slot>

    <div class="p-6 space-y-4">
        <p class="text-gray-700">Bienvenue, {{ Auth::user()->name }} !</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white p-4 shadow rounded-lg">
                <h3 class="text-lg font-semibold">📈 Statistiques générales</h3>
                <ul class="list-disc pl-4 text-sm">
                    <li>Nombre d'étudiants inscrits</li>
                    <li>Nombre d'entreprises</li>
                    <li>Nombre de candidatures</li>
                </ul>
            </div>

            <div class="bg-white p-4 shadow rounded-lg">
                <h3 class="text-lg font-semibold">🛠️ Gestion des utilisateurs</h3>
                <a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:underline">Voir la liste</a>
            </div>

            <div class="bg-white p-4 shadow rounded-lg">
                <h3 class="text-lg font-semibold">📝 Offres en attente</h3>
                <a href="{{ route('admin.offers.pending') }}" class="text-blue-600 hover:underline">Modérer les offres</a>
            </div>
        </div>
    </div>
</x-app-layout>
