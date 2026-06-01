async function generatePDF() {
    const fhsis_month = document.getElementById('fhsis_month')
        ? document.getElementById('fhsis_month').value
        : 'Report';

    const fhsis_year = document.getElementById('fhsis_year')
        ? document.getElementById('fhsis_year').value
        : new Date().getFullYear();

    const brgy_name = document.getElementById('brgy_name')
        ? document.getElementById('brgy_name').value
        : 'Barangay';

    const bhs_name = document.getElementById('bhs_name')
        ? document.getElementById('bhs_name').value
        : 'BHS';

    const municipality = document.getElementById('municipality')
        ? document.getElementById('municipality').value
        : 'Municipality';

    const province = document.getElementById('province')
        ? document.getElementById('province').value
        : 'Province';

    const projected_population = document.getElementById('projected_population')
        ? document.getElementById('projected_population').value
        : 'Population';

    const prepared_by = document.getElementById('prepared_by')
        ? document.getElementById('prepared_by').value
        : 'Prepared By';

    const verified_by = document.getElementById('verified_by')
        ? document.getElementById('verified_by').value
        : 'Verified By';

    const position = document.getElementById('position')
        ? document.getElementById('position').value
        : 'Position';

    const timestamp = new Date();

    const generatedAt = timestamp.toLocaleString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
    });

    showStatus('Generating PDF...', 'info');

    // ================================
    // WRAPPER
    // ================================
    const wrapper = document.createElement('div');

    wrapper.style.fontFamily = 'Arial, sans-serif';
    wrapper.style.padding = '20px';
    wrapper.style.color = '#000';
    wrapper.style.width = '100%';

    wrapper.innerHTML = `
        <div style="text-align:right;font-size:11px;margin-bottom:10px;">
            ${generatedAt}
        </div>

        <div style="text-align:center;margin-bottom:20px;">
            <h2 style="margin:0;font-size:14px;font-weight:bold;">
                Barangay Milagrosa, Calamba City, Laguna
            </h2>

            <h1 style="margin:5px 0;font-size:20px;font-weight:bold;">
                Barangay Health Worker System
            </h1>

            <h3 style="margin:5px 0;font-size:13px;font-weight:normal;">
                FHSIS Monthly Report - ${fhsis_month} ${fhsis_year}
            </h3>
        </div>

        <table style="width:100%;border-collapse:collapse;margin-bottom:25px;font-size:12px;">
            <tr>
                <td style="border:1px solid #000;padding:5px;"><strong>Barangay</strong></td>
                <td style="border:1px solid #000;padding:5px;">${brgy_name}</td>
                <td style="border:1px solid #000;padding:5px;"><strong>BHS Name</strong></td>
                <td style="border:1px solid #000;padding:5px;">${bhs_name}</td>
            </tr>
            <tr>
                <td style="border:1px solid #000;padding:5px;"><strong>Municipality</strong></td>
                <td style="border:1px solid #000;padding:5px;">${municipality}</td>
                <td style="border:1px solid #000;padding:5px;"><strong>Province</strong></td>
                <td style="border:1px solid #000;padding:5px;">${province}</td>
            </tr>
            <tr>
                <td style="border:1px solid #000;padding:5px;"><strong>Population</strong></td>
                <td style="border:1px solid #000;padding:5px;">${projected_population}</td>
                <td style="border:1px solid #000;padding:5px;"><strong>Year</strong></td>
                <td style="border:1px solid #000;padding:5px;">${fhsis_year}</td>
            </tr>
        </table>
    `;

    // ================================
    // ORDERED SECTION EXPORT
    // ================================
    const sectionIds = [
        'section-a',
        'section-b',
        'section-c',
        'section-d',
        'section-e',
        'section-f',
        'section-g',
        'section-vital'
    ];

    sectionIds.forEach((id) => {

        const section = document.getElementById(id);
        if (!section) return;

        const clone = section.cloneNode(true);

        // REMOVE UI ELEMENTS
        clone.querySelectorAll('button').forEach(el => el.remove());
        clone.querySelectorAll('svg').forEach(el => el.remove());
        clone.querySelectorAll('[id$="-spinner"]').forEach(el => el.remove());
        clone.querySelectorAll('[id$="-save-status"]').forEach(el => el.remove());

        // STYLE RESET
        clone.style.boxShadow = 'none';
        clone.style.borderRadius = '0';
        clone.style.marginBottom = '25px';
        clone.style.overflow = 'visible';
        clone.style.display = 'block';

        // HEADINGS
        clone.querySelectorAll('h2').forEach(h => {
            h.style.fontSize = '14px';
            h.style.fontWeight = 'bold';
        });

        clone.querySelectorAll('h3').forEach(h => {
            h.style.fontSize = '12px';
            h.style.fontWeight = 'bold';
        });

        clone.querySelectorAll('h4').forEach(h => {
            h.style.fontSize = '11px';
            h.style.fontWeight = 'bold';
        });

        // INPUT → TEXT
        clone.querySelectorAll('input').forEach(input => {
            let value = input.value || '-';

            const div = document.createElement('div');
            div.textContent = value;

            div.style.fontSize = '10px';
            div.style.padding = '2px';
            div.style.wordBreak = 'break-word';

            if (input.classList.contains('total-cell')) {
                div.style.fontWeight = 'bold';
            }

            input.parentNode.replaceChild(div, input);
        });

        // TABLE STYLE
        clone.querySelectorAll('table').forEach(table => {
            table.style.width = '100%';
            table.style.borderCollapse = 'collapse';
            table.style.fontSize = '9px';
            table.style.marginBottom = '15px';
        });

        clone.querySelectorAll('th').forEach(th => {
            th.style.border = '1px solid #000';
            th.style.padding = '4px';
            th.style.backgroundColor = '#d9d9d9';
        });

        clone.querySelectorAll('td').forEach(td => {
            td.style.border = '1px solid #000';
            td.style.padding = '3px';
            td.style.verticalAlign = 'top';
        });

        wrapper.appendChild(clone);
    });

    // ================================
    // FOOTER
    // ================================
    const footer = document.createElement('div');

    footer.innerHTML = `
        <div style="margin-top:60px;display:flex;justify-content:space-between;text-align:center;font-size:12px;">

            <div style="width:33%;">
                <div style="font-weight:bold;margin-bottom:5px;">${prepared_by}</div>
                <div style="border-top:1px solid #000;padding-top:5px;">Prepared By</div>
            </div>

            <div style="width:33%;">
                <div style="font-weight:bold;margin-bottom:5px;">${verified_by}</div>
                <div style="border-top:1px solid #000;padding-top:5px;">Verified By</div>
            </div>

            <div style="width:33%;">
                <div style="font-weight:bold;margin-bottom:5px;">${position}</div>
                <div style="border-top:1px solid #000;padding-top:5px;">Position</div>
            </div>

        </div>
    `;

    wrapper.appendChild(footer);

    // ================================
    // PDF OPTIONS
    // ================================
    const opt = {
        margin: 0.3,
        filename: `FHSIS_Report_${fhsis_month}_${fhsis_year}.pdf`,
        image: { type: 'jpeg', quality: 1 },
        html2canvas: { scale: 2, useCORS: true, scrollY: 0 },
        jsPDF: { unit: 'in', format: 'a4', orientation: 'landscape' },
        pagebreak: { mode: ['css', 'legacy'] }
    };

    try {
        await html2pdf().set(opt).from(wrapper).save();
        showStatus('PDF generated successfully!', 'success');

    } catch (error) {
        console.error(error);
        showStatus('Failed to generate PDF.', 'error');
    }
}

function showStatus(message, type) {

    const statusEl = document.getElementById('status-message');

    statusEl.textContent = message;

    statusEl.className = `
        mb-4 
        p-4 
        rounded-lg 
        ${
            type === 'success'
            ? 'bg-green-100 text-green-800'
            : type === 'error'
            ? 'bg-red-100 text-red-800'
            : 'bg-blue-100 text-blue-800'
        }
    `;

    statusEl.classList.remove('hidden');

    setTimeout(() => {
        statusEl.classList.add('hidden');
    }, 3000);
}