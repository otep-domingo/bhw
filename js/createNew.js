async function createNewReport() {

    const warningModal = new bootstrap.Modal(
        document.getElementById('warningModal')
    );
    warningModal.show();

    try {
        const response = await fetch(
            '../controller/create_new_report.php',
            {
                method: 'POST'
            }
        );
        const data = await response.json();
        if (data.success) {
            window.location.href = '../pages/analytics.php';
        } else {
            alert('Failed to create new report.');
        }
    } catch (error) {
        console.error(error);
        alert('Something went wrong.');
    }
}

async function proceedCreateNewReport() {

    try {
        const response = await fetch(
            '../controller/create_new_report.php',
            {
                method: 'POST',
                credentials: 'same-origin'
            }
        );
        const data = await response.json();
        if (data.success) {
            window.location.href = '../pages/analytics.php';
        }

    } catch (error) {
        console.error(error);
        alert('Something went wrong.');
    }
}

async function createReportInformation() {
    const formData = {
        fhsis_month: document.querySelector('[name="fhsis-month"]').value,
        fhsis_year: document.querySelector('[name="fhsis-year"]').value,
        barangay_name: document.querySelector('[name="barangay-name"]').value,
        bhs_name: document.querySelector('[name="bhs-name"]').value,
        municipality: document.querySelector('[name="municipality"]').value,
        province: document.querySelector('[name="province"]').value,
        population: document.querySelector('[name="population"]').value,
        prepared_by: document.querySelector('[name="prepared-by"]').value,
        verified_by: document.querySelector('[name="verified-by"]').value,
        position: document.querySelector('[name="position"]').value
    };

    try {
        const response = await fetch('../controller/create_report.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            credentials: 'same-origin',
            body: JSON.stringify(formData)
        });

        const data = await response.json();

        if (data.success) {
            const modalEl = document.getElementById('confirmModal');
            const modalInstance = bootstrap.Modal.getInstance(modalEl);
            modalInstance.hide();
            window.location.href = '../pages/analytics.php?success=1';
        }
        else {
            window.location.href = '../pages/analytics.php';
        }

    } catch (error) {
        console.error(error);
        alert('Server error occurred.');
    }
}