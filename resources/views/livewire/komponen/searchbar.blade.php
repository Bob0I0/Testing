<div class="relative flex-1 me-3 ms-2">
    <flux:input 
    sticky 
    type="text"
    placeholder="Cari Berdasarkan Nomor Surat" 
    icon="magnifying-glass" 
    class="w-full text-lg shadow-md rounded-xl"
    wire:model.live.debounce.300ms="search"
    {{-- wire:keyup="set('search', $event.target.value)" --}}
    />
</div>