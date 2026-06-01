async function searchReportData() {

    const year = document.getElementById('fhsis_year').value;
    const month = document.getElementById('fhsis_month').value;

    const response = await fetch(
        '../controller/search_report.php',
        {
            method: 'POST',

            headers: {
                'Content-Type': 'application/json'
            },

            body: JSON.stringify({
                year: year,
                month: month
            })
        }
    );

    const data = await response.json();
    
    if (data.success) {
        console.log('Report data found:', data.reportData);
    }
    
    window.location.href = '../pages/analytics.php';
}