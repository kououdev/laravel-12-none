// Dashboard functionality
document.addEventListener("DOMContentLoaded", function () {
    "use strict";

    // Initialize feather icons if available
    if (window.feather) {
        window.feather.replace({ "aria-hidden": "true" });
    }

    // Initialize chart if element exists
    var chartElement = document.getElementById("myChart");
    if (chartElement && window.Chart) {
        var myChart = new window.Chart(chartElement, {
            type: "line",
            data: {
                labels: [
                    "Sunday",
                    "Monday",
                    "Tuesday",
                    "Wednesday",
                    "Thursday",
                    "Friday",
                    "Saturday",
                ],
                datasets: [
                    {
                        data: [15339, 21345, 18483, 24003, 23489, 24092, 12034],
                        tension: 0,
                        backgroundColor: "transparent",
                        borderColor: "#007bff",
                        borderWidth: 4,
                        pointBackgroundColor: "#007bff",
                    },
                ],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: false,
                    },
                },
                plugins: {
                    legend: {
                        display: false,
                    },
                },
            },
        });
    }
});
