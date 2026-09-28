<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Voorraad aanpassen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="mb-4 text-sm text-gray-600">
                        {{ __('Pas het aantal aanwezige producten per voorraadregel aan. Deze actie is alleen '
                            .'beschikbaar voor de rol Administrator.') }}
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
                                        {{ __('Barcode') }}
                                    </th>
                                    <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">
                                        {{ __('Verpakkingseenheid (kg)') }}
                                    </th>
                                    <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">
                                        {{ __('Aantal aanwezig') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse ($voorraadregels as $regel)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3 whitespace-nowrap font-medium text-gray-900">
                                            {{ $regel->product?->Naam ?? __('Onbekend product') }}
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-gray-700">
                                            {{ $regel->product?->Barcode ?? '-' }}
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-gray-700">
                                            {{ $regel->VerpakkingsEenheid }}
                                        </td>
                                        <td class="px-4 py-3">
                                            <form method="post"
                                                  action="{{ route('magazijn.voorraad.bijwerken', $regel) }}"
                                                  class="flex items-center gap-2">
                                                @csrf
                                                @method('PUT')

                                                <x-text-input type="number"
                                                              name="AantalAanwezig"
                                                              min="0"
                                                              max="65535"
                                                              required
                                                              class="w-28"
                                                              :value="$regel->AantalAanwezig ?? 0" />

                                                <x-primary-button>{{ __('Opslaan') }}</x-primary-button>
                                            </form>

                                            @error('AantalAanwezig')
                                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                            @enderror
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                                            {{ __('Er zijn geen voorraadregels aanwezig.') }}
                                        </td>
                                    </tr>
                                @endforelse
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
