<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Levering Informatie') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (! $heeftVoorraad)
                        {{-- Scenario 2: geen voorraad aanwezig -> exacte melding + redirect na 4 seconden --}}
                        <div class="rounded-lg border border-amber-300 bg-amber-50 p-6">
                            <p class="text-base text-gray-900">{{ $geenVoorraadMelding }}</p>
                        </div>
                    @else
                        {{-- Scenario 1: leveringsinformatie van het product --}}
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $product->Naam }}</h3>
                            <p class="text-sm text-gray-600">
                                {{ __('Barcode') }}: {{ $product->Barcode }}
                                &middot; {{ __('Verwachte eerstvolgende levering') }}:
                                {{ $verwachteEerstvolgendeLevering?->format('d-m-Y') ?? __('niet ingepland') }}
                            </p>
                        </div>

                        <dl class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                            <div class="rounded-lg border border-gray-200 bg-gray-50 p-4">
                                <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                                    {{ __('Naam leverancier') }}
                                </dt>
                                <dd class="mt-1 text-base text-gray-900">
                                    {{ $leverancier?->Naam ?? __('Onbekend') }}
                                </dd>
                            </div>
                            <div class="rounded-lg border border-gray-200 bg-gray-50 p-4">
                                <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                                    {{ __('Contactpersoon leverancier') }}
                                </dt>
                                <dd class="mt-1 text-base text-gray-900">
                                    {{ $leverancier?->ContactPersoon ?? __('Onbekend') }}
                                </dd>
                            </div>
                            <div class="rounded-lg border border-gray-200 bg-gray-50 p-4">
                                <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                                    {{ __('Leveranciernummer') }}
                                </dt>
                                <dd class="mt-1 text-base text-gray-900">
                                    {{ $leverancier?->LeverancierNummer ?? __('Onbekend') }}
                                </dd>
                            </div>
                            <div class="rounded-lg border border-gray-200 bg-gray-50 p-4">
                                <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                                    {{ __('Mobiel') }}
                                </dt>
                                <dd class="mt-1 text-base text-gray-900">
                                    {{ $leverancier?->Mobiel ?? __('Onbekend') }}
                                </dd>
                            </div>
                        </dl>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 text-sm">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">
                                            {{ __('Datum laatste levering') }}
                                        </th>
                                        <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">
                                            {{ __('Aantal') }}
                                        </th>
                                        <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">
                                            {{ __('Datum eerstvolgende levering') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @forelse ($leveringen as $levering)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-3 whitespace-nowrap text-gray-900">
                                                {{ $levering->DatumLevering->format('d-m-Y') }}
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap text-gray-700">
                                                {{ $levering->Aantal }}
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap text-gray-700">
                                                {{ $levering->DatumEerstVolgendeLevering?->format('d-m-Y') ?? __('-') }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="px-4 py-6 text-center text-gray-500">
                                                {{ __('Van dit product zijn nog geen leveringen bekend.') }}
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @endif

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

    @if (! $heeftVoorraad)
        {{-- Scenario 2: na 4 seconden automatisch terug naar het overzicht --}}
        <script>
            setTimeout(function () {
                window.location = @json(route('magazijn.index'));
            }, 4000);
        </script>
    @endif
</x-app-layout>
