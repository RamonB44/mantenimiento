import './bootstrap';
import "/node_modules/select2/dist/css/select2.css";
import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import { Ripple, Select, Tab, initTE  } from "tw-elements";

initTE({ Select, Ripple, Tab });

Alpine.plugin(focus);

Alpine.start();

window.multiSelect = (DOMElement) => {
    const multiSelect = document.querySelector(DOMElement);
    const multiSelectInstance = Select.getInstance(multiSelect);
    return multiSelectInstance
}
