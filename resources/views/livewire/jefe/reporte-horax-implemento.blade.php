<div class="xs:container mx-auto w-full">
    <section class="mb-4 text-center lg:text-left">
        @livewire('jefe.reporte-horax-implemento.select')
    </section>
    <section>
        @livewire('jefe.reporte-horax-implemento.table')
    </section>
</div>

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // datos obligatorios para generar reporte
            const sedes = window.multiSelect("#sedes");
            const users = window.multiSelect("#supervisor");
            const tmaquina = window.multiSelect("#tmaquina");

            const months = window.multiSelect("#months");
            const weeks = window.multiSelect("#weeks");
            const days = window.multiSelect("#days");
        });
    </script>
@endsection
