import './bootstrap';
import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import { Ripple, Select, Tab, Datepicker, Input, Chart, initTE } from "tw-elements";
window.Alpine = Alpine;

initTE({ Select, Ripple, Tab, Datepicker, Input, Chart });

Alpine.plugin(focus);

Alpine.start();

window.multiSelect = (DOMElement) => {
    const multiSelect = document.querySelector(DOMElement);
    const multiSelectInstance = Select.getInstance(multiSelect);
    return multiSelectInstance
}

window.datepicker = (DOMElement, DatePicketOptions) => {
    const datepickerDisableFuture = document.querySelector(DOMElement);
    return new Datepicker(datepickerDisableFuture, DatePicketOptions);
}

window.chart = (DOMElement, typeChart, barData) => {
    const dataBarHorizontal = {
        type: typeChart,
        data: barData,
    };

    const optionsBarHorizontal = {
        options: {
            indexAxis: "y",
            scales: {
                x: {
                    stacked: true,
                    grid: {
                        display: true,
                        borderDash: [2],
                        zeroLineColor: "rgba(0,0,0,0)",
                        zeroLineBorderDash: [2],
                        zeroLineBorderDashOffset: [2],
                    },
                    ticks: {
                        color: "rgba(0,0,0, 0.5)",
                    },
                },
                y: {
                    stacked: true,
                    grid: {
                        display: false,
                    },
                    ticks: {
                        color: "rgba(0,0,0, 0.5)",
                    },
                },
            },
        },
    };

    return new Chart(
        document.querySelector(DOMElement),
        dataBarHorizontal,
        optionsBarHorizontal
    );
}

window.initTE = () => {
    initTE({ Select, Ripple, Tab, Datepicker, Input, Chart });
}
