<div class="flex flex-col w-full mx-auto gap-8 p-8 xl:p-8 2xl:p-10 xl:gap-8 2xl:gap-10">
    <div class="flex items-center justify-between ">
        <h1 class="text-3xl font-semibold capitalize text-primary">Add Consultation</h1>
        <a href="{{ route('consultations.index') }}"
            class="text-sm rounded-lg px-4 py-2 hover:bg-primary-800 text-white font-normal bg-primary tt text-normal capitalize">view
            Consultation</a>
    </div>
    <div class="shadow bg-white p-4 md:p-8 rounded-lg">
        <form wire:submit.prevent="save" class="grid w-full grid-cols-1 gap-4 md:gap-8 md:grid-cols-2 lg:grid-cols-4">
            <div class="w-full h-12 space-y-1">
                <select wire:model.defer="patient_id"
                    class='w-full h-full pl-4 space-y-1 font-medium text-gray-500 placeholder-gray-500 capitalize shadow bg-gray-100 border-0 rounded peer tt focus:bg-white focus:outline-none'
                    id="">
                    <option value="select" class="text-sm">Patient *</option>
                    @foreach ($patients as $patient)
                    <option class="py-2 capitalize" value="{{ $patient->id }}">{{ $patient->name }}</option>
                    @endforeach
                </select>
                @error('patient_id')
                <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="w-full h-12 space-y-1">
                <select wire:model.defer="user_id"
                    class='w-full h-full pl-4 space-y-1 font-medium text-gray-500 placeholder-gray-500 capitalize shadow bg-gray-100 border-0 rounded peer tt focus:bg-white focus:outline-none'
                    id="">
                    <option value="select" class="text-sm">Doctor *</option>
                    @foreach ($doctors as $doctor)
                    <option class="py-2 capitalize" value="{{ $doctor->id }}">
                        {{ $doctor->title . ' '.$doctor->first_name . ' '. $doctor->last_name}}
                    </option>
                    @endforeach
                </select>
                @error('user_id')
                <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <x-text-input label="Consulation fee*" name="fee" type="text" wire:model.defer="fee" />
            <div class="flex items-center gap-x-4 bg-gray-100 rounded-lg px-4">
                <input id="admitted" type="checkbox" wire:model="admitted" class="rounded-sm focus:text-primary">
                <label class="text-sm" for="admitted">Admitted Patient</label>
            </div>
            <div class="rounded-lg md:col-span-2">
                <textarea name="" id="" cols="30" rows="3" wire:model.defer="purpose"
                    placeholder="Purpose of consultation/ailments/illness"
                    class="w-full border-0 rounded-lg placeholder:text-gray-300 text-gray-500 shadow"></textarea>
                @error('purpose')
                <span class="mb-2 text-red-600 text-sm pt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex flex-col  gap-2 p-3 rounded-lg">
                <label class="text-sm" for="admitted_at">Date Visited</label>
                <input id="admitted_at" type="date" wire:model="visited_at"
                    class="rounded-lg uppercase border-0 text-sm py-2 bg-gray-100 focus:text-primary">
                @error('visited_at')
                <span class="mb-2 text-red-600 text-sm pt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex flex-col  gap-2 p-3 rounded-lg">
                <label class="text-sm" for="checkout">Date Checkout</label>
                <input id="checkout" type="date" wire:model="checkout_at"
                    class="rounded-lg uppercase border-0 text-sm py-2 bg-gray-100 focus:text-primary">
                @error('checkout_at')
                <span class="mb-2 text-red-600 text-sm pt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="w-full md:col-span-2 lg:col-span-4 gap-4 md:gap-8">
                <div class="flex mb-2 justify-between items-center">
                    <h1 class="font-medium text-xl">Add Inventories</h1>
                </div>
                <table class="w-full" style="background-color: white; padding:0px">
                    <thead class="tr my-2 bg-gray-50 border-y ">
                        <th class="p-2 border-x ">Inventories</th>
                        <th class="p-2">Quantity</th>
                    </thead>
                    @foreach($orders as $key => $order)
                    <tr class="w-full odd:bg-white oddRow">
                        <td class="border">
                            <select wire:model="orders.{{ $key }}.inventory_id"
                                class='w-full h-full pl-4 space-y-1 font-medium text-gray-500 placeholder-gray-500 capitalize shadow bg-gray-100 border-0 rounded peer tt focus:bg-white focus:outline-none'
                                id="">
                                <option value="select" class="text-sm">-- Inventory --</option>
                                @foreach ($inventories as $inventory)
                                <option class="py-1 capitalize" value="{{ $inventory->id }}">
                                    <pre>{!! $inventory->name . '&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;' . ' ('.$inventory->category. ')' !!} #{{ moneyFormat($inventory->price) }} 
                                        </pre>
                                </option>
                                @endforeach
                            </select>
                            @error('inventory_id')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </td>
                        <td class="border">
                            <input value="{{ $order['quantity'] }}" type="number"
                                class="px-4 py-2 w-[80px] rounded-lg shadow border-0"
                                wire:model="orders.{{ $key }}.quantity">
                            <span wire:click="removeOrder({{ $key }})"
                                class="px-4 cursor-pointer py-2 rounded-lg bg-red-100 text-red-600 text-sm">Delete</span>
                        </td>
                    </tr>
                    @endforeach

                </table>
                <span wire:click="addOrder"
                    class="text-white mt-2 cursor-pointer inline-block bg-green-500 tt hover:bg-green-700 text-sm py-2 max-w-max rounded px-4">Add
                    more Inventory
                </span>
            </div>
            <div class="w-full flex justify-end md:col-span-2 lg:col-span-4">
                <button type="submit" class="px-4 py-2 rounded-lg text-white bg-primary tt">save</button>
            </div>
        </form>
    </div>
</div>
@push('styles')
<style>
    tr.oddRow:odd td {
        background-color: white !important;
    }
</style>
@endpush