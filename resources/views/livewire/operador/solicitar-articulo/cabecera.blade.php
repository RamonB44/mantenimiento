<div style="display:flex; align-items:center;justify-content:center;margin-bottom:15px">
    <div class="grid grid-cols-1 gap-4">
        <div class="text-center">
            <h1 class="text-4xl font-bold">
                PEDIDO DE {{ strtoupper($fecha_pedido) }}
            </h1>
        </div>
        <div class="grid grid-cols-1 gap-4">
            <div class="text-center">
                <h1 class="text-xl font-bold">
                    Falta {{  $fecha_de_cierre  }} para el cierre
                </h1>
            </div>
        </div>
        @if ($monto_usado > $monto_asignado)
            <div class="px-6 mx-6 mt-4 cursor-default" title="Este monto es calculado de todos las solicitudes del ceco" >
                <div class="w-full p-4 text-2xl font-black text-center text-white bg-red-600 rounded-lg">
                    EL MONTO REBASA AL ASIGNADO
                </div>
            </div>
        @endif
    </div>
</div>