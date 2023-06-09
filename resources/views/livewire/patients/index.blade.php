<div class="flex flex-col w-full mx-auto gap-8 p-8 xl:p-8 2xl:p-10 xl:gap-8 2xl:gap-10">
    {{-- form --}}
    {{-- modal forms and inputs components --}}
    <x-modal class="max-w-lg">
        <x-form title="patient" :update="$update">
            <div class="grid grid-cols-2 mb-2 gap-4">
                <div class="w-full h-12 space-y-1">
                    <select wire:model.defer="title"
                        class='w-full h-full pl-4 space-y-1 font-medium text-gray-500 placeholder-gray-500 capitalize bg-gray-100 border-0 rounded peer tt focus:bg-white focus:outline-none'
                        id="">
                        <option value="select" class="text-sm">Title*</option>
                        @foreach ($titles as $option)
                        <option class="py-2 capitalize" value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </select>
                    @error('title')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="w-full h-12 space-y-1">
                    <select wire:model.defer="status"
                        class='w-full h-full pl-4 space-y-1 capitalize font-medium text-gray-500 placeholder-gray-500 bg-gray-100 border-0 rounded peer tt focus:bg-white focus:outline-none'
                        id="">
                        <option value="select" class="text-sm">Patient Type</option>
                        @foreach ($type as $option)
                        <option class="py-2 uppercase" value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </select>
                    @error('status')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <x-text-input label="Patient Name*" name="name" type="text" wire:model.defer="name" />
            <x-text-input label="Email*" name="email" type="text" wire:model.defer="email" />
            <x-text-input label="Phone Number*" name="phone" type="text" wire:model.defer="phone" />
            <x-text-input label="Address*" name="address" type="text" wire:model.defer="address" />
        </x-form>
    </x-modal>
    {{-- buttons --}}
    <div class="flex items-center justify-between ">
        <div class="flex items-center space-x-6">
            <h1 class="text-3xl font-semibold capitalize text-primary">patients</h1>
            @if ($checked)
            <button class="font-normal btn btn-secondary">Select All {{ count($checked) }}</button>
            <x-button.bulk-delete />
            @else
            <x-button.add name="patients" />
            @endif

        </div>

        {{-- right side --}}
        <div class="flex items-center space-x-6">
            <x-search name="patients" />
        </div>
    </div>

    {{-- tables --}}
    <div class="w-full px-4 pb-4 overflow-x-auto bg-white rounded-lg shadow-sm">
        @if (\App\Models\Patient::count() > 0)
        <table class="w-full space-y-2 overflow-x-auto whitespace-nowrap">
            <thead class="w-full pb-4 text-xl border-b">
                <tr class="font-medium">
                    <th class="p-2 whitespace-nowrap"></th>
                    <th class="p-2 text-lg font-medium text-left">Patient ID</th>
                    <th class="p-2 text-lg font-medium text-left">Name</th>
                    <th class="p-2 text-lg font-medium text-left">Phone</th>
                    {{-- <th class="p-2 text-lg font-medium text-left">Country</th> --}}
                    <th class="p-2 text-lg font-medium text-left">Visited Last</th>
                    <th class="p-2 text-lg font-medium text-left">Status</th>
                    <th class="p-2"></th>
                </tr>
            </thead>
            <tbody class="w-full overflow-x-auto break-normal">
                @forelse ($patients as $patient)
                <tr class="">
                    <td class="p-2 whitespace-nowrap">
                        <input type="checkbox" wire:model="checked" id="" value="{{ $patient->id }}"
                            class="block rounded whitespace-nowrap text-primary focus:outline-none focus:ring-primary">
                    </td>
                    <td class="p-2 whitespace-nowrap">
                        <p class="uppercase">{{ $patient->patient_id }}</p>
                    </td>
                    <td class="p-2 whitespace-nowrap">
                        {{ $patient->title . ' ' .$patient->name }}
                    </td>
                    <td class="p-2 whitespace-nowrap">
                        {{ $patient->phone }}
                    </td>
                    {{-- <td class="p-2 text-sm capitalize whitespace-nowrap">
                    {{ $patient->nationality }}
                    </td> --}}
                    <td class="p-2 whitespace-nowrap">
                        <p class="text-sm">{{ $patient->updated_at->diffForHumans() }}</p>
                    </td>
                    <td class="p-2 whitespace-nowrap">
                        @if ($patient->status == 'in-patient')
                        <span
                            class="p-1 text-xs uppercase rounded bg-green-100 text-green-600 px-2 shadow">{{ $patient->status }}</span>
                        @else
                        <span
                            class="p-1 text-xs uppercase rounded bg-red-100 text-red-600 px-2 shadow">{{ $patient->status }}</span>
                        @endif
                    </td>
                    <td class="p-2 whitespace-nowrap">
                        <div class="flex space-x-2 item-center">
                            <span wire:click="edit({{ $patient->id }})"
                                class="w-8 h-8 p-2 text-blue-600 border border-blue-600 rounded-md cursor-pointer tt hover:-translate-y-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="my-auto bi bi-eye" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                    <path
                                        d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                </svg>
                            </span>
                            <span wire:click="confirmDelete({{ $patient->id }})"
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
                {{ $patients->links() }}
            </x-per-page>
        </div>
        @else
        <div class="p-8 text-center">
            <p class="font-medium text-xl">No patient yet, add patients to the system</p>
        </div>
        @endif
    </div>
</div>