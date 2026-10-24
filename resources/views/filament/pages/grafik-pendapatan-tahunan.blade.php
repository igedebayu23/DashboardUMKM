<x-filament-panels::page>
    <x-filament::section>
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:gap-4">
            <label for="selectedUmkm" class="text-sm font-medium text-gray-700 dark:text-gray-200 whitespace-nowrap">
                Pilih UMKM:
            </label>
            <div class="w-full sm:w-80">
                <x-filament::input.wrapper>
                    <x-filament::input.select wire:model.live="selectedUmkm" id="selectedUmkm">
                        @forelse ($this->umkmOptions as $id => $nama)
                            <option value="{{ $id }}">{{ $nama }}</option>
                        @empty
                            <option value="">Belum ada UMKM</option>
                        @endforelse
                    </x-filament::input.select>
                </x-filament::input.wrapper>
            </div>
        </div>
    </x-filament::section>

    @livewire(
        \App\Filament\Widgets\PendapatanTahunanChart::class,
        ['umkmId' => $this->selectedUmkm],
        key('chart-' . ($this->selectedUmkm ?? 'none'))
    )
</x-filament-panels::page>
