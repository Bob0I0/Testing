<div>
    <flux:button wire:click='plas'>Button</flux:button>
    @session("success")
    <div id="toast" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="z-[9999] fixed top-10 right-10 flex items-center bg-white text-black text-sm font-medium px-4 py-3 rounded-lg shadow-lg border border-gray-300">
        <!-- Success Icon -->
        <div class="bg-green-100 p-1 rounded-full mr-3">
            <svg class="w-5 h-5 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>

        <!-- Message -->
        <span>YOOO</span>

        <!-- Close Button -->
        <button onclick="document.getElementById('toast').remove()" class="ml-4 text-gray-500 hover:text-black">
            ✕
        </button>
    </div>
    @endsession
</div>
