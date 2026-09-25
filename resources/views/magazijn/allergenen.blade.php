<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Overzicht Allergenen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (! $heeftAllergenen)
                        {{-- Scenario 2: geen allergenen -> exacte melding + redirect na 4 seconden --}}
                        <div class="rounded-lg border border-green-300 bg-green-50 p-6">
                            <p class="text-base text-gray-900">{{ $geenAllergenenMelding }}</p>
                        </div>
                    @else
                        {{-- Scenario 1: alle allergenen van het product --}}
                        <dl class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div class="rounded-lg border border-gray-200 bg-gray-50 p-4">
                                <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                                    {{ __('Naam Product') }}
                                </dt>
                                <dd class="mt-1 text-base text-gray-900">{{ $product->Naam }}</dd>
                            </div>
                            <div class="rounded-lg border border-gray-200 bg-gray-50 p-4">
                                <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                                    {{ __('Barcode') }}
                                </dt>
                                <dd class="mt-1 text-base text-gray-900">{{ $product->Barcode }}</dd>
                            </div>
                        </dl>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 text-sm">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">
                                            {{ __('Naam') }}
                                        </th>
                                        <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">
                                            {{ __('Omschrijving') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach ($allergenen as $allergeen)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-3 whitespace-nowrap font-medium text-gray-900">
                                                {{ $allergeen->Naam }}
                                            </td>
                                            <td class="px-4 py-3 text-gray-700">
                                                {{ $allergeen->Omschrijving }}
                                            </td>
                                        </tr>
                                    @endforeach
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

    @if (! $heeftAllergenen)
        {{-- Scenario 2: na 4 seconden automatisch terug naar het overzicht --}}
        <script>
            setTimeout(function () {
                window.location = @json(route('magazijn.index'));
            }, 4000);
        </script>
    @endif
</x-app-layout>
