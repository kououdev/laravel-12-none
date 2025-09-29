// 1. Laravel bootstrap (axios, echo, dll)
import "./bootstrap";

// 2. CSS global
import "../css/app.css";
import "../css/dashboard.css";

// 3. JS Library tambahan (bootstrap, alpine, dll)
import "bootstrap/dist/js/bootstrap.bundle";
import feather from "feather-icons";
import Chart from "chart.js/auto";

// 4. Initialize feather icons
window.feather = feather;
window.Chart = Chart;

// 5. Global Feather Icons Function
function initFeatherIcons() {
    if (window.feather) {
        feather.replace({ "aria-hidden": "true" });
    }
}

// 6. Auto-initialize Feather icons for Livewire
document.addEventListener("DOMContentLoaded", initFeatherIcons);
document.addEventListener("livewire:updated", initFeatherIcons);
document.addEventListener("livewire:navigated", initFeatherIcons);

// 7. Make function globally available
window.initFeatherIcons = initFeatherIcons;

// 8. Custom dashboard JS
import "../js/dashboard";
