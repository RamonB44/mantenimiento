import './bootstrap';
import "/node_modules/select2/dist/css/select2.css";
import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
window.Alpine = Alpine;

Alpine.plugin(focus);

Alpine.start();
