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
        var users = null;
        document.addEventListener('DOMContentLoaded', function() {
            // $(".js-mimplemento-matcher").select2({
            //     matcher: matchCustom
            // });
        });

        Livewire.hook('message.received', (message, component) => {
            // console.log(message)
            // console.log(component)

            // if (component.name == "jefe.reporte-horax-implemento.select") {
            //     // document.querySelector();
            //     // let supervisores = document.querySelector("#supervisor");
            //     // supervisores.querySelectorAll(":scope > option").forEach(element => {
            //     //     // console.log(element.value)
            //     //     element.hidden = true;
            //     //     if(element.value){
            //     //         let filtered = component.data.filterSupervisors.filter(e => e.id == element.value);
            //     //         console.log(filtered);
            //     //     }
            //     // });
            //     // component.data.filterSupervisors.forEach(e => {
            //     //     // let element = users.options.filter(ele => ele.value == e.id).map(v => v.hidden = true);
            //     //     let elements = supervisores.querySelectorAll(":scope > option");
            //     //     let filter = Array.prototype.filter;
            //     //     filter.call(elements, function(node) {
            //     //         console.log(node)
            //     //         if(node.value == e.id){
            //     //             document.querySelector(node).hidden = true;
            //     //         }
            //     //     });
            //     // });
            // }
        });
    </script>
@endsection
