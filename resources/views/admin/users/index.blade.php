<!-- resources/views/admin/users/index.blade.php -->
<x-app-layout>
    {{-- Pas de header slot pour éviter la barre blanche du layout --}}

    <!-- En-tête sombre interne -->
    <div class="relative">
        <div class="absolute inset-0 -z-10 bg-gradient-to-b from-[#0b153a]/40 via-[#0a0f2b]/60 to-black/80"></div>
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-10">
            <h1 class="text-3xl md:text-4xl font-extrabold text-white drop-shadow">
                Gestion des utilisateurs
            </h1>
            <p class="mt-2 text-gray-300">Liste, rôles et actions d’administration.</p>
        </div>
    </div>

    <!-- Corps sombre -->
    <div class="bg-gradient-to-b from-black via-[#070b1f] to-[#050713] py-10">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            @include('components.flash-messages')

            <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur overflow-hidden">
                <div class="px-6 py-5 border-b border-white/10">
                    <h2 class="text-xl font-bold text-white">Liste des utilisateurs</h2>
                </div>

                <div class="p-6 overflow-x-auto">
                    <table class="min-w-full text-sm text-left">
                        <thead class="text-white/80 uppercase tracking-wider">
                            <tr class="border-b border-white/10">
                                <th class="px-4 py-3">Nom</th>
                                <th class="px-4 py-3">Email</th>
                                <th class="px-4 py-3">Rôle actuel</th>
                                <th class="px-4 py-3 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/10">
                            @forelse($users as $user)
                                @php
                                    $role = $user->role ?? 'utilisateur';
                                    $roleClasses = match ($role) {
                                        'admin' => 'bg-red-400/20 text-red-200 border border-red-400/30',
                                        'coach' => 'bg-emerald-400/20 text-emerald-200 border border-emerald-400/30',
                                        default => 'bg-white/10 text-gray-200 border border-white/15',
                                    };
                                @endphp
                                <tr class="hover:bg-white/5">
                                    <td class="px-4 py-3 text-white">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-white/10 ring-1 ring-white/15 flex items-center justify-center text-xs text-white/80">
                                                {{ strtoupper(substr($user->name,0,1)) }}
                                            </div>
                                            <span class="truncate">{{ $user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <a href="mailto:{{ $user->email }}" class="text-sky-400 hover:text-sky-300">
                                            {{ $user->email }}
                                        </a>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-[11px] font-medium {{ $roleClasses }}">
                                            {{ ucfirst($role) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center justify-center gap-2">
                                            <a
                                                href="{{ route('admin.users.edit', $user) }}"
                                                class="inline-flex items-center rounded-lg px-3 py-1.5 text-xs font-medium text-white bg-sky-500/90 hover:bg-sky-400 shadow-sm shadow-sky-500/20 transition"
                                            >
                                                Modifier le rôle
                                            </a>

                                            @if($user->id !== auth()->id())
                                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        type="submit"
                                                        class="inline-flex items-center rounded-lg px-3 py-1.5 text-xs font-medium text-white bg-red-500/90 hover:bg-red-500 shadow-sm shadow-red-500/20 transition"
                                                    >
                                                        Supprimer
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-6 text-center text-white/70">
                                        Aucun utilisateur trouvé.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    @if(method_exists($users, 'links'))
                        <div class="mt-6">
                            <div class="rounded-xl border border-white/10 bg-white/5 backdrop-blur p-3 text-center">
                                {{ $users->onEachSide(1)->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
