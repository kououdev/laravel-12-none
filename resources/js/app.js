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

// 5. Custom dashboard JS
import "../js/dashboard";
