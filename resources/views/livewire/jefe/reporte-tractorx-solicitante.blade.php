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
        var barChart = null;

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
            datasets: [],
        }

        const getRandomColor = () => {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        document.addEventListener('DOMContentLoaded', function() {
            // datos obligatorios para generar reporte
            window.multiSelect("#sedes");
            window.multiSelect("#solicitante");

            barChart = window.chart('#bar-chart-horizontal', "bar", barData)
        });

        // Livewire.hook('element.updated', (el, component) => {
        //     console.log(component.data);
        // })

        Livewire.hook('message.received', (message, component) => {
            console.log(component.name);
            console.log(component.data)
            if (component.name == 'jefe.reporte-tractorx-solicitante.table') {
                // update chart js
                const data = component.data.newData;
                const labels = component.data.labels;
                const hidden = component.data.hidden;
                const netoData = component.data.netoData;
                const tag = component.data.tag;
                console.log(labels)
                updateBChart(data, labels, hidden, tag);
            }
        })

        function updateBChart(data, labels, hidden, tag) {
            // console.log(barChart._data);
            barChart._data.data.labels = labels;
            var max = tag.length;
            var dataset = [];
            barChart._data.data.datasets = [];
            for (let index = 0; index < max; index++) {
                var color = getRandomColor();
                dataset = {
                    label: tag[index],
                    backgroundColor: color,
                    hidden: hidden[index],
                    data: data[index]
                }
                barChart._data.data.datasets.push(dataset);
            }
            barChart.update();
        }
    </script>
@endsection
