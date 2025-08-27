
@session('success')
    <div id="toast" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" 
    class="z-[1000] fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex items-center bg-white text-black text-sm font-medium px-4 py-7 rounded-lg shadow-lg border border-gray-300">
        <!-- Success Icon -->
        <div class="flex flex-col items-center justify-center rounded-md dark:bg-zinc-200 mx-11">
            <img src="{{ asset('images/correct.png') }}" alt="Logo" class="mx-auto mb-4 rounded-xl" style="width: 250px; height: 112px; object-fit: contain;">

            <!-- Message -->
            <p>{{$value}}</p>
        </div>
    </div>
@endsession