<div
    class="fixed bottom-0 inset-x-0 px-4 pb-6 sm:inset-0 sm:p-0 sm:flex sm:items-center sm:justify-center"
    wire:click.stop="">

    <div class="fixed inset-0 transition-opacity" wire:click.stop="$set('isModalOpen', false)">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>

    <div class="bg-white rounded-lg px-4 pt-5 pb-4 overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full sm:p-6"
         role="dialog"
         aria-modal="true"
         aria-labelledby="modal-headline">

        <h1 class="text-indigo-600 text-xl font-medium">
            Tambah Reminder
        </h1>

        <div class="grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6 mt-4">
            <div class="sm:col-span-6">
                <label for="first_name" class="block text-sm font-medium leading-5 text-gray-700">
                    Nama Kegiatan
                </label>
                <div class="mt-1 rounded-md shadow-sm">
                    <input
                        wire:model.lazy="newReminder.nama_kegiatan"
                        class="border rounded p-2 block w-full sm:text-sm sm:leading-5"
                        placeholder="Apa nama kegiatannya?"
                    />
                </div>
            </div>
            <div class="sm:col-span-6">
                <label for="first_name" class="block text-sm font-medium leading-5 text-gray-700">
                    Tempat Acara
                </label>
                <div class="mt-1 rounded-md shadow-sm">
                    <input
                        wire:model.lazy="newReminder.tempat_acara"
                        class="border rounded p-2 block w-full sm:text-sm sm:leading-5"
                        placeholder="Dimana tempat acara berlangusng?"
                    />
                </div>
            </div>

            <div class="sm:col-span-6">
                <label for="about" class="block text-sm font-medium leading-5 text-gray-700">
                    Keterangan
                </label>
                <div class="mt-1 rounded-md shadow-sm">
                    <textarea
                        rows="3"
                        wire:model.lazy="newReminder.keterangan"
                        placeholder="Detail dari reminder"
                        class="border rounded p-2 block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                    ></textarea>
                </div>
            </div>

            <div class="sm:col-span-3">
                <label for="first_name" class="block text-sm font-medium leading-5 text-gray-700">
                    Dijadwalkan pada tanggal
                </label>
                <div class="mt-1 rounded-md shadow-sm">
                    <input
                        type="date"
                        wire:model.lazy="newReminder.tgl_kegiatan"
                        class="border rounded p-2 block w-full sm:text-sm sm:leading-5"
                        placeholder="Kapan reminder berlangsung?"
                    />
                </div>
            </div>

            <div class="sm:col-span-3">
                <label for="first_name" class="block text-sm font-medium leading-5 text-gray-700">
                    Dijadwalkan pada waktu
                </label>
                <div class="mt-1 rounded-md shadow-sm">
                    <input
                        type="time"
                        wire:model.lazy="newReminder.waktu_kegiatan"
                        class="border rounded p-2 block w-full sm:text-sm sm:leading-5"
                        placeholder="Jam berapa reminder berlangsung?"
                    />
                    <small><b><i>atau bisa dibilang jam {{ $newReminder['waktu_kegiatan'] }}</i></b></small>
                </div>
            </div>

            <div class="sm:col-span-6">
                <label for="first_name" class="block text-sm font-medium leading-5 text-gray-700">
                    Priority
                </label>
                <div class="mt-1 rounded-md shadow-sm">
                    <select
                        wire:model.lazy="newReminder.priority"
                        class="border appearance-none bg-white rounded p-2 block w-full sm:text-sm sm:leading-5">
                        <option value="high">High</option>
                        <option value="normal">Normal</option>
                        <option value="low">Low</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="mt-5 sm:mt-6    sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
            <div class="flex w-full rounded-md shadow-sm sm:col-start-2">
                <button
                    type="button"
                    wire:click.prevent="saveReminder"
                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-indigo-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                    Konfirmasi
                </button>
            </div>
            <div class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:col-start-1">
                {{-- <button
                    type="button"
                    wire:click="$set('isModalOpen', false)"
                    class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                    Cancel
                </button> --}}
            </div>
        </div>
    </div>
</div>
