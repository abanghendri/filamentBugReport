<x-filament-panels::page>
<div class="space-y-6 divide-y divide-gray-900/10 dark:divide-white/10">
        <form wire:submit="save">
            {{ $this->form }}
            
            <x-filament::button class="mt-2" type="submit">
                Submit
            </x-filament::button>
            
        </form>
    </div>

</x-filament-panels::page>
