<div class="flex flex-col w-full mx-auto gap-8 p-8 xl:p-8 2xl:p-10 xl:gap-8 2xl:gap-10">
    <div class="flex items-center justify-between ">
        <div class="flex items-center space-x-6">
            <h1 class="text-3xl font-semibold capitalize text-primary">Consultations</h1>
            @if ($checked)
            <button class="font-normal btn btn-secondary">Select All {{ count($checked) }}</button>
            <x-button.bulk-delete />
            @else
            <a href="{{ route('consultations.create') }}"
                class="text-sm btn btn-primary tt text-normal capitalize">Create
                Consultation</a>
            @endif

        </div>

        {{-- right side --}}
        <div class="flex items-center space-x-6">
            <x-search name="consultations" />
        </div>
    </div>

    {{-- tables --}}
    <div class="w-full px-4 pb-4 overflow-x-auto bg-white rounded-lg shadow-sm">
        @if (\App\Models\Consultation::count() > 1)
        <table class="w-full space-y-2 overflow-x-auto whitespace-nowrap">
            <thead class="w-full pb-4 text-xl border-b">
                <tr class="font-medium">
                    <th class="p-2 whitespace-nowrap"></th>
                    <th class="p-2 text-lg font-medium text-left">Name</th>
                    <th class="p-2 text-lg font-medium text-left">Code</th>
                    <th class="p-2 text-lg font-medium text-left">Price</th>
                    <th class="p-2 text-lg font-medium text-left">Categories</th>
                    <th class="p-2 text-lg font-medium">Quantity</th>
                    <th class="p-2"></th>
                </tr>
            </thead>
            <tbody class="w-full overflow-x-auto break-normal">
                @forelse ($consultations as $consultation)
                <tr class="">
                    <td class="p-2 whitespace-nowrap">
                        <input type="checkbox" wire:model="checked" id="" value="{{ $consultation->id }}"
                            class="block rounded whitespace-nowrap text-primary focus:outline-none focus:ring-primary">
                    </td>
                    <td class="p-2 whitespace-nowrap capitalize">
                        {{ $consultation->name }}
                    </td>
                    <td class="p-2 text-black text-sm">
                        {!! DNS1D::getBarcodeHTML("$consultation->code", 'C39+', 1, 30, "BLACK") !!}
                        <span class="">{{ $consultation->code }}</span>
                    </td>
                    <td class="p-2 whitespace-nowrap">
                        <span class="py-1 px-2 rounded text-sm text-green-600 bg-green-100"> &#8358;
                            {{ moneyFormat($consultation->price) }}</span>
                    </td>
                    <td class="p-2 whitespace-nowrap text-sm uppercase">
                        {{ $consultation->category }}
                    </td>
                    <td class="p-2 whitespace-nowrap text-center">
                        {{ $consultation->quantity }}
                    </td>
                    {{-- <td class="p-2 whitespace-nowrap">
                    @if ($consultation->status == 'in-consultation')
                    <span
                        class="p-1 text-xs uppercase rounded bg-green-100 text-green-600 px-2 shadow">{{ $consultation->status }}</span>
                    @else
                    <span
                        class="p-1 text-xs uppercase rounded bg-red-100 text-red-600 px-2 shadow">{{ $consultation->status }}</span>
                    @endif
                    </td> --}}
                    <td class="p-2 whitespace-nowrap">
                        <div class="flex space-x-2 item-center">
                            <span wire:click="edit({{ $consultation->id }})"
                                class="w-8 h-8 p-1 text-blue-600 border border-blue-600 rounded-md cursor-pointer tt hover:-translate-y-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="m19.3 8.925l-4.25-4.2l1.4-1.4q.575-.575 1.413-.575t1.412.575l1.4 1.4q.575.575.6 1.388t-.55 1.387L19.3 8.925ZM4 21q-.425 0-.713-.288T3 20v-2.825q0-.2.075-.388t.225-.337l10.3-10.3l4.25 4.25l-10.3 10.3q-.15.15-.337.225T6.825 21H4Z" />
                                </svg>
                            </span>
                            <span wire:click="confirmDelete({{ $consultation->id }})"
                                class="w-8 h-8 p-2 text-red-600 border border-red-600 rounded-md cursor-pointer tt hover:-translate-y-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path
                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                </svg>
                            </span>
                        </div>
                    </td>
                </tr>
                @empty
                <h1 class="text-2xl font-bold">No records found in the database</h1>
                @endforelse
            </tbody>
        </table>

        {{-- pagnation components --}}
        <div class="mt-4">
            <x-per-page>
                {{ $consultations->links() }}
            </x-per-page>
        </div>
        @else
        <div class="p-8 text-center">
            <p class="font-medium text-xl">No consultation yet, add consultations to the system</p>
        </div>
        @endif
    </div>
</div>