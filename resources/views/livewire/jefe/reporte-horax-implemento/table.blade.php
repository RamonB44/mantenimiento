<div class="grid xs:grid-cols-1 sm:grid-cols-4 xl:gap-x-12 gap-4">

    @forelse ($data as $item)
        <div class="mb-6 lg:mb-0">
            <div class="relative block rounded-lg shadow-lg bg-white p-6">
                <div class="lg:flex flex-row items-center">
                    <div class="grow-0 shrink-0 basis-auto w-full lg:w-7/12">
                        <h5 class="text-lg font-bold mb-2">{{ $dias_semana[\Carbon\Carbon::parse($item->fecha)->dayOfWeek + 1] }}</h5>
                        <p class="text-gray-500 mb-4">Total de Horas: {{ $item->Horas_Usado }}</p>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div>

        </div>
    @endforelse
</div>
