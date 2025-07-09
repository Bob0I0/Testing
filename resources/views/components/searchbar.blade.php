<div class="relative flex-1 me-3 ms-2">
    <flux:input sticky placeholder="Pencarian..." icon="magnifying-glass" class="w-full text-lg shadow-md rounded-xl"/>
    <flux:dropdown align="end" class="absolute inset-y-1 right-1">
      <flux:profile circle 
                  :chevron="false" 
                  avatar:badge 
                  avatar:badge:color="green"
                  avatar:badge:circle 
                  :initials="auth()->user()->initials()"
                  class="h-8 w-8" 
                  avatar:color="cyan"
                  />
      <flux:menu class="max-w-[12rem]">
        <flux:menu.radio.group>      
          <div class="grid flex-1 text-start text-sm leading-tight">
              <span class="font-semibold">{{ auth()->user()->name }}</span>
              <span class="text-sm">{{ auth()->user()->email }}</span>
          </div>
          <flux:menu.separator />
        </flux:menu.radio.group>  
        <flux:menu.radio.group>
          <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
        </flux:menu.radio.group>
        
        <flux:menu.radio.group>  
          <form method="POST" action="{{ route('logout') }}" class="w-full">
              @csrf
              <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                  {{ __('Log Out') }}
              </flux:menu.item>
          </form>
        </flux:menu.radio.group>
      </flux:menu>
    </flux:dropdown>
</div>