import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.showInvite = function() {
    document.getElementById("toast-bottom-right").style.visibility = "visible";
    document.getElementById("toast-bottom-right").style.transitionDuration = "1s";
    document.getElementById("toast-bottom-right").style.opacity = 1;
}
window.hideInvite = function() {
    document.getElementById("toast-bottom-right").style.visibility = "hidden";
    document.getElementById("toast-bottom-right").style.transitionDuration = "1s";
    document.getElementById("toast-bottom-right").style.opacity = 0;
}