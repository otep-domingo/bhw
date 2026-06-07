// Configuration
const defaultConfig = {
    report_title: 'Barangay Health Workers',
    primary_color: '#15803d',
    secondary_color: '#f0fdf4',
    text_color: '#1f2937',
    accent_color: '#047857',
    surface_color: '#ffffff'
};

let config = { ...defaultConfig };
let currentReportId = null;
let allReports = [];

// Data structure for table rows
const tableData = [
    { category: '1. MATERNAL CARE', isHeader: true },
    { id: 'maternal_1_1', label: '1.1 Bilang ng Bagong Buntis na Nanay ngayong Buwan sa Komunidad' },
    { id: 'maternal_1_2', label: '1.2 Bilang ng Nanay na Buntis na nabigyan ng kaalaman ng Danger Sign' },
    { id: 'maternal_1_3', label: '1.3 Bilang ng Nanay na Buntis na nakipag-ugnayan sa Health Center' },
    { id: 'maternal_1_4', label: '1.4 Bilang ng Nanay na may Birth Plan' },
    { category: '2. DELIVERY', isHeader: true },
    { id: 'delivery_2_1', label: '2.1 Mga Nanay na buntis na nagsilang sa:' },
    { id: 'delivery_2_1a', label: '    a. Bahay', indent: true },
    { id: 'delivery_2_1b', label: '    b. Pasilidad', indent: true },
    { category: '3. POST-PARTUM', isHeader: true },
    { id: 'postpartum_3_1', label: '3.1 Bilang ng nanganak na Nanay na sinubaybayan para bumalik sa Health Center' },
    { category: '4. CHILDCARE', isHeader: true },
    { id: 'childcare_4_1', label: '4.1 Bilang ng mga bagong silang na sanggol na may Newborn Screening' },
    { category: '5. NATIONAL IMMUNIZATION PROGRAM', isHeader: true },
    { id: 'nip_5_1', label: '5.1 Bilang ng Bagong Panganak na Sanggol (1–28 days of life)' },
    { id: 'nip_5_2', label: '5.2 Fully Immunized Child (0–11 months)' },
    { id: 'nip_5_3', label: '5.3 Missed Child' },
    { id: 'nip_5_4', label: '5.4 Completely Immunized Child (12 months above)' },
    { category: '6. NUTRITION', isHeader: true },
    { id: 'nutrition_6_1', label: '6.1 Napurga + Micronutrient Supplementation' },
    { id: 'nutrition_6_2', label: '6.2 Buntis na nabigyan ng:' },
    { id: 'nutrition_6_2a', label: '    a. Calcium Carbonate', indent: true },
    { id: 'nutrition_6_2b', label: '    b. Iron with Folic Acid', indent: true },
    { id: 'nutrition_6_3', label: '6.3 Nagpapasusong ina na nabigyan ng:' },
    { id: 'nutrition_6_3a', label: '    a. Vitamin A', indent: true },
    { id: 'nutrition_6_3b', label: '    b. Iron with Folic Acid', indent: true },
    { id: 'nutrition_6_4', label: '6.4 Napayuhan sa wastong pagpapasuso' },
    { category: '7. FAMILY PLANNING', isHeader: true },
    { id: 'fp_7_1', label: '7.1 Operated women (BTL / hysterectomy)' },
    { id: 'fp_7_2', label: '7.2 Not using modern planning methods' },
    { id: 'fp_7_3', label: '7.3 Using modern planning methods' }
];

const months = ['jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec'];
const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

// Initialize table
function initializeTable() {
    const tbody = document.getElementById('tableBody');
    tbody.innerHTML = '';

    tableData.forEach(row => {
        const tr = document.createElement('tr');

        if (row.isHeader) {
            tr.className = 'bg-green-100';
            tr.innerHTML = `<td colspan="14" class="sticky-col bg-green-100 px-3 py-2 font-bold text-green-800 border-b border-green-200">${row.category}</td>`;
        } else {
            tr.className = 'hover:bg-gray-50 border-b border-gray-100';
            let labelClass = row.indent ? 'pl-6' : '';

            let cells = `<td class="sticky-col bg-white px-3 py-2 text-gray-700 border-r border-gray-100 ${labelClass}">${row.label}</td>`;

            months.forEach(month => {
                cells += `<td class="px-1 py-1 text-center"><input type="number" min="0" id="${row.id}_${month}" class="w-full text-center border border-gray-200 rounded px-1 py-1 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500" value="0" onchange="updateRowTotal('${row.id}'); updateSummary()"></td>`;
            });

            cells += `<td class="px-2 py-2 text-center font-bold bg-green-50 text-green-800" id="${row.id}_total">0</td>`;
            tr.innerHTML = cells;
        }

        tbody.appendChild(tr);
    });
}

// Update row total
function updateRowTotal(rowId) {
    let total = 0;
    months.forEach(month => {
        const input = document.getElementById(`${rowId}_${month}`);
        if (input) {
            total += parseInt(input.value) || 0;
        }
    });
    const totalCell = document.getElementById(`${rowId}_total`);
    if (totalCell) {
        totalCell.textContent = total;
    }
    return total;
}

// Update summary
function updateSummary() {
    const categoryTotals = {};
    const monthlyTotals = {};
    let grandTotal = 0;

    months.forEach(m => monthlyTotals[m] = 0);

    // Category definitions
    const categories = {
        'Maternal Care': ['maternal_1_1', 'maternal_1_2', 'maternal_1_3', 'maternal_1_4'],
        'Delivery': ['delivery_2_1a', 'delivery_2_1b'],
        'Post-Partum': ['postpartum_3_1'],
        'Childcare': ['childcare_4_1'],
        'Immunization': ['nip_5_1', 'nip_5_2', 'nip_5_3', 'nip_5_4'],
        'Nutrition': ['nutrition_6_1', 'nutrition_6_2a', 'nutrition_6_2b', 'nutrition_6_3a', 'nutrition_6_3b', 'nutrition_6_4'],
        'Family Planning': ['fp_7_1', 'fp_7_2', 'fp_7_3']
    };

    Object.keys(categories).forEach(cat => {
        categoryTotals[cat] = 0;
        categories[cat].forEach(rowId => {
            months.forEach(month => {
                const input = document.getElementById(`${rowId}_${month}`);
                if (input) {
                    /* The code snippet is attempting to parse an integer value from the input element's value and assign
                    it to the variable `val`. If parsing is unsuccessful, it defaults to 0. It then adds the parsed
                    value to the `categoryTotals` object under the key `cat`. The code seems to be incomplete as it ends
                    abruptly with `monthlyT`. */
                    const val = parseInt(input.value) || 0;
                    categoryTotals[cat] += val;
                    monthlyTotals[month] += val;
                    grandTotal += val;
                }
            });
        });
    });

    // Update category totals display
    const categoryContainer = document.getElementById('categoryTotals');
    categoryContainer.innerHTML = '';
    const colors = ['green', 'blue', 'purple', 'amber', 'rose', 'cyan', 'orange'];
    let colorIndex = 0;

    Object.entries(categoryTotals).forEach(([cat, total]) => {
        const color = colors[colorIndex % colors.length];
        const div = document.createElement('div');
        div.className = `bg-${color}-50 rounded-lg p-3 border-l-4 border-${color}-500`;
        div.innerHTML = `<div class="text-lg font-bold text-${color}-700">${total}</div><div class="text-xs text-gray-600">${cat}</div>`;
        categoryContainer.appendChild(div);
        colorIndex++;
    });

    // Update monthly chart
    const chartContainer = document.getElementById('monthlyChart');
    chartContainer.innerHTML = '';
    const maxMonthly = Math.max(...Object.values(monthlyTotals), 1);

    months.forEach(month => {
        const val = monthlyTotals[month];
        const height = (val / maxMonthly) * 100;
        const bar = document.createElement('div');
        bar.className = 'flex-1 bg-green-500 rounded-t transition-all duration-300 hover:bg-green-600 relative group';
        bar.style.height = `${Math.max(height, 2)}%`;
        bar.innerHTML = `<div class="absolute -top-6 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">${val}</div>`;
        chartContainer.appendChild(bar);
    });

    // Update statistics
    document.getElementById('totalYear').textContent = grandTotal;

    // Find highest and lowest months
    let highest = { month: '', value: -1 };
    let lowest = { month: '', value: Infinity };

    months.forEach((month, index) => {
        if (monthlyTotals[month] > highest.value) {
            highest = { month: monthNames[index], value: monthlyTotals[month] };
        }
        if (monthlyTotals[month] < lowest.value) {
            lowest = { month: monthNames[index], value: monthlyTotals[month] };
        }
    });

    document.getElementById('highestMonth').textContent = `${highest.month} (${highest.value})`;
    document.getElementById('lowestMonth').textContent = `${lowest.month} (${lowest.value})`;

    // Generate text summary
    const year = document.getElementById('inputYear').value || 'the year';
    const bhwName = document.getElementById('inputBHW').value || 'the BHW';
    const barangay = document.getElementById('inputBarangay').value || 'the barangay';

    let summaryText = `For ${year}, ${bhwName} from ${barangay} has recorded a total of ${grandTotal} accomplishments across all health programs. `;

    if (grandTotal > 0) {
        const topCategory = Object.entries(categoryTotals).sort((a, b) => b[1] - a[1])[0];
        summaryText += `The highest performing category is ${topCategory[0]} with ${topCategory[1]} total activities. `;
        summaryText += `Performance peaked in ${highest.month} with ${highest.value} accomplishments, while ${lowest.month} recorded the lowest with ${lowest.value} activities. `;

        // Family planning methods summary
        const modernMethods = [];
        const naturalMethods = [];
        if (document.getElementById('fp_pills').checked) modernMethods.push('Pills');
        if (document.getElementById('fp_injectables').checked) modernMethods.push('Injectables');
        if (document.getElementById('fp_btl').checked) modernMethods.push('BTL');
        if (document.getElementById('fp_vasectomy').checked) modernMethods.push('Vasectomy');
        if (document.getElementById('fp_implant').checked) modernMethods.push('Implant');
        if (document.getElementById('fp_condom').checked) modernMethods.push('Condom');
        if (document.getElementById('fp_cm').checked) naturalMethods.push('CM');
        if (document.getElementById('fp_bbt').checked) naturalMethods.push('BBT');
        if (document.getElementById('fp_stm').checked) naturalMethods.push('STM');
        if (document.getElementById('fp_sdm').checked) naturalMethods.push('SDM');

        if (modernMethods.length > 0 || naturalMethods.length > 0) {
            summaryText += `Family planning methods utilized include: `;
            if (modernMethods.length > 0) summaryText += `Modern (${modernMethods.join(', ')})`;
            if (modernMethods.length > 0 && naturalMethods.length > 0) summaryText += ` and `;
            if (naturalMethods.length > 0) summaryText += `Natural (${naturalMethods.join(', ')})`;
            summaryText += `. `;
        }
    } else {
        summaryText += 'No data has been entered yet. Please fill in the monthly accomplishment data above.';
    }

    document.getElementById('summaryText').textContent = summaryText;
}

// Collect all data
function collectData() {
    const data = {
        header: {
            year: document.getElementById('inputYear').value,
            bhw_name: document.getElementById('inputBHW').value,
            barangay: document.getElementById('inputBarangay').value,
            area: document.getElementById('inputArea').value
        },
        tableValues: {},
        familyPlanning: {
            pills: document.getElementById('fp_pills').checked,
            injectables: document.getElementById('fp_injectables').checked,
            btl: document.getElementById('fp_btl').checked,
            vasectomy: document.getElementById('fp_vasectomy').checked,
            implant: document.getElementById('fp_implant').checked,
            condom: document.getElementById('fp_condom').checked,
            cm: document.getElementById('fp_cm').checked,
            bbt: document.getElementById('fp_bbt').checked,
            stm: document.getElementById('fp_stm').checked,
            sdm: document.getElementById('fp_sdm').checked
        }
    };

    tableData.forEach(row => {
        if (!row.isHeader && row.id) {
            data.tableValues[row.id] = {};
            months.forEach(month => {
                const input = document.getElementById(`${row.id}_${month}`);
                if (input) {
                    data.tableValues[row.id][month] = parseInt(input.value) || 0;
                }
            });
        }
    });

    return data;
}

// Load data into form
async function loadData(selectedId) {
    //alert(selectedId);
    //if (!data) return;

    //the selectedId here handles the ID of the selected monthly report from the dropdown
    try {
        const response = await fetch(`../controller/monthlyReport.php/${selectedId}`);
        const data = await response.json();
        console.log('data values: ', data);


        if (data.header) {
            document.getElementById('inputYear').value = data.header.year || '';
            document.getElementById('inputBHW').value = data.header.bhw_name || '';
            document.getElementById('inputBarangay').value = data.header.barangay || '';
            document.getElementById('inputArea').value = data.header.area || '';
        }

        if (data.tableValues) {
            Object.keys(data.tableValues).forEach(rowId => {
                months.forEach(month => {
                    const input = document.getElementById(`${rowId}_${month}`);
                    if (input && data.tableValues[rowId][month] !== undefined) {
                        input.value = data.tableValues[rowId][month];
                    }
                });
                updateRowTotal(rowId);
            });
        }

        if (data.familyPlanning) {
            console.log('family planning: ', data.familyPlanning);
            document.getElementById('fp_pills').checked = data.familyPlanning.fp_pills || false;
            document.getElementById('fp_injectables').checked = data.familyPlanning.fp_injectables || false;
            document.getElementById('fp_btl').checked = data.familyPlanning.fp_btl || false;
            document.getElementById('fp_vasectomy').checked = data.familyPlanning.fp_vasectomy || false;
            document.getElementById('fp_implant').checked = data.familyPlanning.fp_implant || false;
            document.getElementById('fp_condom').checked = data.familyPlanning.fp_condom || false;
            document.getElementById('fp_cm').checked = data.familyPlanning.fp_cm || false;
            document.getElementById('fp_bbt').checked = data.familyPlanning.fp_bbt || false;
            document.getElementById('fp_stm').checked = data.familyPlanning.fp_stm || false;
            document.getElementById('fp_sdm').checked = data.familyPlanning.fp_sdm || false;
        }

        updateSummary();
    } catch (err) {
        console.error(err);
    }
}

// Clear form
function clearForm() {
    document.getElementById('inputYear').value = '';
    document.getElementById('inputBHW').value = '';
    document.getElementById('inputBarangay').value = '';
    document.getElementById('inputArea').value = '';

    tableData.forEach(row => {
        if (!row.isHeader && row.id) {
            months.forEach(month => {
                const input = document.getElementById(`${row.id}_${month}`);
                if (input) input.value = 0;
            });
            updateRowTotal(row.id);
        }
    });

    document.getElementById('fp_pills').checked = false;
    document.getElementById('fp_injectables').checked = false;
    document.getElementById('fp_btl').checked = false;
    document.getElementById('fp_vasectomy').checked = false;
    document.getElementById('fp_implant').checked = false;
    document.getElementById('fp_condom').checked = false;
    document.getElementById('fp_cm').checked = false;
    document.getElementById('fp_bbt').checked = false;
    document.getElementById('fp_stm').checked = false;
    document.getElementById('fp_sdm').checked = false;

    updateSummary();
}

// Show toast notification
/*function showToast(message) {
    const toast = document.getElementById('toast');
    const toastMessage = document.getElementById('toastMessage');
    toastMessage.textContent = message;
    toast.classList.remove('translate-y-20', 'opacity-0');
    setTimeout(() => {
        toast.classList.add('translate-y-20', 'opacity-0');
    }, 3000);
}*/
//------------TOAST/MODAL DIALOG
function showToast(message = 'Report saved successfully!') {
    const toast = document.getElementById('toast');
    const toastBox = document.getElementById('toastBox');
    document.getElementById('toastMessage').textContent = message;

    toast.classList.remove('opacity-0', 'pointer-events-none');
    toastBox.classList.remove('scale-95');
    toastBox.classList.add('scale-100');
}

function closeToast() {
    const toast = document.getElementById('toast');
    const toastBox = document.getElementById('toastBox');

    toast.classList.add('opacity-0', 'pointer-events-none');
    toastBox.classList.remove('scale-100');
    toastBox.classList.add('scale-95');
}

// Close on backdrop click
document.getElementById('toast').addEventListener('click', function (e) {
    if (e.target === this) closeToast();
});
//------------END OF MODAL DIALOG

// Update report selector
async function updateReportSelector() {
    //alert('reload');
    const selector = document.getElementById('reportSelector');
    const currentValue = selector.value;

    selector.innerHTML = '<option value="new">+ New Report</option>';

    //set the hidden value to "new" for every refresh of the page
    const h = document.getElementById('selectedReportOption');
    h.value = "new";

    //fetch the reports from the controller
    try {
        const response = await fetch('../controller/monthlyReport.php', {
            method: 'GET',
            credentials: "same-origin",
            headers: { 'Content-Type': 'application/json' },
        });

        const result = await response.json();
        console.log('reports: ', result);

        result.forEach(r => {
            console.log(r.id, " ", r.year, " ", r.bhw_name);
            const option = document.createElement('option');
            option.value = r.id;
            const label = `${r.bhw_name || 'Unnamed'} - ${r.year || 'No Year'} (${r.barangay || 'No Barangay'})`;
            option.textContent = label;
            selector.appendChild(option);
        });

        /*allReports.forEach(report => {
            const option = document.createElement('option');
            option.value = report.__backendId;
            const label = `${report.bhw_name || 'Unnamed'} - ${report.year || 'No Year'} (${report.barangay || 'No Barangay'})`;
            option.textContent = label;
            selector.appendChild(option);
        });*/

        if (currentReportId) {
            selector.value = currentReportId;
        }

        document.getElementById('deleteBtn').classList.toggle('hidden', !currentReportId);
    } catch (err) {
        console.error(err);
    }
}

// Load selected report
function loadSelectedReport() {

    const selector = document.getElementById('reportSelector');
    const selectedId = selector.value;

    if (selectedId === 'new') {
        currentReportId = null;
        clearForm();
        document.getElementById('deleteBtn').classList.add('hidden');

        //make sure to set the hiddne value to "new"
        const h = document.getElementById('selectedReportOption');
        h.value = "new";
        return;
    }

    //const report = allReports.find(r => r.__backendId === selectedId);
    //alert(selectedId);
    //if (report) {
    //currentReportId = report.__backendId;
    currentReportId = selectedId;
    try {
        //const data = JSON.parse(report.data || '{}');
        //const data = JSON
        loadData(currentReportId);
        const h = document.getElementById('selectedReportOption');
        h.value = currentReportId;
    } catch (e) {
        console.error('Error parsing report data:', e);
    }
    document.getElementById('deleteBtn').classList.remove('hidden');
    //}
}

// Save report
async function saveReport() {

    const formData = collectData();
    const now = new Date().toISOString();

    const selector = document.getElementById('selectedReportOption');
    const selectedId = selector.value;
    currentReportId = selectedId;

    if (currentReportId !== 'new') {
        console.log('updating record: ', selector);
        try {
            const response = await fetch(`../controller/monthlyReport.php/${currentReportId}`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(formData)
            });

            const data = await response.json();

            if (!response.ok) {
                //console.error('Error:', data.error);
                showToast(data.error);
                return;
            }

            console.log('update successful data: ', data); // "Report updated successfully."
            showToast("Report successfully updated!")
        } catch (err) {
            //console.error('Request failed:', err);
            showToast(err);
        }

    } else {
        const newReport = {
            report_id: 'RPT_' + Date.now(),
            year: formData.header.year,
            bhw_name: formData.header.bhw_name,
            barangay: formData.header.barangay,
            area: formData.header.area,
            data: JSON.stringify(formData),
            created_at: now,
            updated_at: now
        };
        /*const result = await window.dataSdk.create(newReport);
        if (result.isOk) {
            showToast('Report saved successfully!');
        } else {
            showToast('Failed to save report');
        }*/
        try {
            const response = await fetch('../controller/monthlyReport.php', {
                method: 'POST',
                credentials: "same-origin",
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(formData),
            });
            const data = await response.json();
            if (!response.ok) {
                //console.error('Error: ', data.error);
                showToast(data.error);
                return;
            }
            //if successful
            console.log('Created Report ID: ', data.id);
            console.log(data.message);
            showToast(data.message);

        } catch (error) {
            console.error('Request failed:', error);
            showToast('Failed to save report');
        }
    }
}

// Delete current report
async function deleteCurrentReport() {
    if (!currentReportId || !window.dataSdk) return;

    const report = allReports.find(r => r.__backendId === currentReportId);
    if (!report) return;

    // Replace delete button with confirmation
    const deleteBtn = document.getElementById('deleteBtn');
    const originalHTML = deleteBtn.innerHTML;
    deleteBtn.innerHTML = 'Confirm Delete?';
    deleteBtn.classList.add('bg-red-700');

    const confirmHandler = async () => {
        const result = await window.dataSdk.delete(report);
        if (result.isOk) {
            currentReportId = null;
            clearForm();
            showToast('Report deleted successfully!');
        } else {
            showToast('Failed to delete report');
        }
        deleteBtn.innerHTML = originalHTML;
        deleteBtn.classList.remove('bg-red-700');
        deleteBtn.removeEventListener('click', confirmHandler);
        deleteBtn.addEventListener('click', deleteCurrentReport);
    };

    deleteBtn.removeEventListener('click', deleteCurrentReport);
    deleteBtn.addEventListener('click', confirmHandler);

    // Reset after 3 seconds if not confirmed
    setTimeout(() => {
        if (deleteBtn.innerHTML === 'Confirm Delete?') {
            deleteBtn.innerHTML = originalHTML;
            deleteBtn.classList.remove('bg-red-700');
            deleteBtn.removeEventListener('click', confirmHandler);
            deleteBtn.addEventListener('click', deleteCurrentReport);
        }
    }, 3000);
}

// Export to Excel (CSV format)
function exportToExcel() {
    const formData = collectData();
    let csv = 'BHW Monthly Accomplishment Report\n';
    csv += `Year,${formData.header.year}\n`;
    csv += `BHW Name,${formData.header.bhw_name}\n`;
    csv += `Barangay,${formData.header.barangay}\n`;
    csv += `Area,${formData.header.area}\n\n`;
    csv += 'Program/Activity,Jan,Feb,Mar,Apr,May,Jun,Jul,Aug,Sep,Oct,Nov,Dec,Total\n';

    tableData.forEach(row => {
        if (row.isHeader) {
            csv += `"${row.category}",,,,,,,,,,,,,\n`;
        } else if (row.id) {
            let rowTotal = 0;
            let rowCsv = `"${row.label.trim()}"`;
            months.forEach(month => {
                const val = formData.tableValues[row.id]?.[month] || 0;
                rowCsv += `,${val}`;
                rowTotal += val;
            });
            rowCsv += `,${rowTotal}\n`;
            csv += rowCsv;
        }
    });

    const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
    const link = document.createElement('a');
    const url = URL.createObjectURL(blob);
    link.setAttribute('href', url);
    link.setAttribute('download', `BHW_Report_${formData.header.year || 'export'}.csv`);
    link.style.visibility = 'hidden';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    showToast('Excel file exported!');
}

// Data handler for SDK
const dataHandler = {
    onDataChanged(data) {
        allReports = data || [];
        updateReportSelector();
    }
};

// Initialize Element SDK
if (window.elementSdk) {
    window.elementSdk.init({
        defaultConfig,
        onConfigChange: async (newConfig) => {
            config = { ...defaultConfig, ...newConfig };
            document.getElementById('main-title').textContent = config.report_title || defaultConfig.report_title;
        },
        mapToCapabilities: (config) => ({
            recolorables: [
                {
                    get: () => config.primary_color || defaultConfig.primary_color,
                    set: (value) => window.elementSdk.setConfig({ primary_color: value })
                },
                {
                    get: () => config.secondary_color || defaultConfig.secondary_color,
                    set: (value) => window.elementSdk.setConfig({ secondary_color: value })
                },
                {
                    get: () => config.text_color || defaultConfig.text_color,
                    set: (value) => window.elementSdk.setConfig({ text_color: value })
                },
                {
                    get: () => config.accent_color || defaultConfig.accent_color,
                    set: (value) => window.elementSdk.setConfig({ accent_color: value })
                },
                {
                    get: () => config.surface_color || defaultConfig.surface_color,
                    set: (value) => window.elementSdk.setConfig({ surface_color: value })
                }
            ],
            borderables: [],
            fontEditable: undefined,
            fontSizeable: undefined
        }),
        mapToEditPanelValues: (config) => new Map([
            ['report_title', config.report_title || defaultConfig.report_title]
        ])
    });
}

// Initialize Data SDK
async function initDataSdk() {
    if (window.dataSdk) {
        const result = await window.dataSdk.init(dataHandler);
        if (!result.isOk) {
            console.error('Failed to initialize data SDK');
        }
    }
}

//load the value of the dropdown report
window.addEventListener("load", function () {
    updateReportSelector();
});

// Initialize app
initializeTable();
updateSummary();
initDataSdk();
