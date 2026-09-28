<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gebruikers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="mb-4 text-sm text-gray-600">
                        {{ __('Beheer de rollen van de accounts. Iedere rol kan het magazijnoverzicht en de '
                            .'informatieschermen bekijken; alleen Administrator mag de voorraad bijwerken en rollen '
                            .'wijzigen.') }}
                    </p>

                    @if (session('status'))
                        <div class="mb-4 rounded-lg border border-green-300 bg-green-50 px-4 py-3 text-sm text-green-800">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">
                                        {{ __('Naam') }}
                                    </th>
                                    <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">
                                        {{ __('E-mailadres') }}
                                    </th>
                                    <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">
                                        {{ __('Rol') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach ($gebruikers as $gebruiker)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3 whitespace-nowrap font-medium text-gray-900">
                                            {{ $gebruiker->name }}
                                            @if ($gebruiker->is(auth()->user()))
                                                <span class="ms-1 text-xs text-gray-400">({{ __('jij') }})</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-gray-700">
                                            {{ $gebruiker->email }}
                                        </td>
                                        <td class="px-4 py-3">
                                            @if ($gebruiker->is(auth()->user()))
                                                <span class="inline-flex items-center rounded-md bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-700">
                                                    {{ $gebruiker->rolename }}
                                                </span>
                                            @else
                                                <form method="post"
                                                      action="{{ route('gebruiker.rol', $gebruiker) }}"
                                                      class="flex items-center gap-2">
                                                    @csrf
                                                    @method('PATCH')

                                                    <select name="rolename"
                                                            class="w-56 rounded-md border-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                                                        @foreach ($rollen as $rol)
                                                            <option value="{{ $rol }}"
                                                                @selected($gebruiker->rolename === $rol)>
                                                                {{ $rol }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    <x-primary-button>{{ __('Opslaan') }}</x-primary-button>
                                                </form>

                                                @error('rolename')
                                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                                @enderror
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('magazijn.index') }}"
                           class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">
                            {{ __('Terug naar Overzicht Magazijn Jamin') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
