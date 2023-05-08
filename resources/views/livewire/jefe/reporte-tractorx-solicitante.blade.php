<div class="xs:container mx-auto w-full">
    <section class="mb-4 text-center lg:text-left">
        @livewire('jefe.reporte-tractorx-solicitante.select')
    </section>
    <section>
        @livewire('jefe.reporte-tractorx-solicitante.table')
    </section>
</div>

@section('js')
    <script>
        const barChart = null;

        var barData = {
            labels: [
                "Lunes",
                "Martes",
                "Miercoles",
                "Jueves",
                "Viernes",
                "Sabado",
                "Domingo",
            ],
            datasets: [{
                    label: "Parruda",
                    data: [30, 15, 62, 65, 61, 65, 40],
                    backgroundColor: "red",
                },
                {
                    label: "Tractor",
                    data: [30, 15, 62, 65, 61, 65, 40],
                    backgroundColor: "blue",
                },
            ],
        }

        document.addEventListener('DOMContentLoaded', function() {
            // datos obligatorios para generar reporte
            const sedes = window.multiSelect("#sedes");
            const solicitante = window.multiSelect("#solicitante");

            const datePickerInit = window.datepicker('#datepicker-init', {
                disableFuture: true,
                querySelector: true,
                // options...
            });
            const datePicketEnd = window.datepicker('#datepicker-end', {
                disableFuture: true,
                querySelector: true,
                // options...
            });

            barChart = window.chart('#bar-chart-horizontal', "bar", barData)
        });


    </script>
@endsection
