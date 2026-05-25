let analyticsChart = null;

function generateAnalytics() {

    document.getElementById('analyticsModal').style.display = 'flex';

    generateAnalyticsChart();
}

function closeAnalytics() {

    document.getElementById('analyticsModal').style.display = 'none';
}

function generateAnalyticsChart() {

    // DEMAND SATISFIED DATA
    const age10_14 = parseInt(
        document.querySelector('input[name="demand[0][0]"]')?.value || 0
    );

    const age15_19 = parseInt(
        document.querySelector('input[name="demand[0][1]"]')?.value || 0
    );

    const age20_49 = parseInt(
        document.querySelector('input[name="demand[0][2]"]')?.value || 0
    );

    const total = parseInt(
        document.querySelector('input[name="demand[0][3]"]')?.value || 0
    );

    // MODERN FP TOTALS
    let modernFpTotals = [];

    document.querySelectorAll('#modern-fp-body tr').forEach((row) => {

        const methodName =
            row.querySelector('td')?.innerText || 'Unknown';

        const totalCell =
            row.querySelector('input[data-col="t"]');

        const totalValue =
            parseInt(totalCell?.value || 0);

        modernFpTotals.push({
            method: methodName,
            total: totalValue
        });
    });

    const ctx = document
        .getElementById('analyticsChart')
        .getContext('2d');

    if (analyticsChart) {
        analyticsChart.destroy();
    }

    analyticsChart = new Chart(ctx, {

        type: 'bar',

        data: {

            labels: [
                'Age 10-14',
                'Age 15-19',
                'Age 20-49',
                'Total WRA'
            ],

            datasets: [

                {
                    label: 'Demand Satisfied',

                    data: [
                        methodName,
                        age10_14,
                        age15_19,
                        age20_49,
                        total
                    ],

                    backgroundColor: [
                        '#3b82f6',
                        '#10b981',
                        '#f59e0b',
                        '#ef4444'
                    ],

                    borderRadius: 8
                }

            ]
        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            plugins: {

                legend: {
                    display: true
                },

                title: {
                    display: true,
                    text: 'Family Planning Demand Analytics'
                }
            },

            scales: {

                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

window.onclick = function(event) {

    const modal = document.getElementById('analyticsModal');

    if (event.target === modal) {
        closeAnalytics();
    }
}