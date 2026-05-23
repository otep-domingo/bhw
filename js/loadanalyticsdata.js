function collectTableRowsInputField(tbodyId) {
    const tbody = document.getElementById(tbodyId);
    if (!tbody) return [];

    return Array.from(tbody.querySelectorAll('tr')).map(tr => {
        const row = {};

        // Prefer data-field attributes
        tr.querySelectorAll('[data-field]').forEach(el => {
            row[el.dataset.field] = el.value ?? el.textContent.trim();
        });

        // If no data-field attributes found, fall back to positional fields
        if (Object.keys(row).length === 0) {
            const cells = tr.querySelectorAll('td');
            cells.forEach((td, i) => {
                const input = td.querySelector('input, select, textarea');
                row[`col_${i}`] = input ? input.name : td.textContent.trim();
            });
        }

        // Always capture the row indicator/label from the first cell
        const firstCell = tr.querySelector('td:first-child');
        if (firstCell && !row.indicator) {
            const input = firstCell.querySelector('input');
            row.indicator = input ? input.name : firstCell.textContent.trim();
        }

        return row;
    }).filter(row => Object.keys(row).length > 0); // skip completely empty rows
}

async function populateSectionsAToH(s) {

    switch (s) {
        case 'A':

            break;
        case 'B':
            break;
    }
    //process section A
    //get all the fields in each section
    const textfields = {
        d: collectTableRowsInputField('demand-body'),//a
        m: collectTableRowsInputField('modern-fp-body'),//a
        //section B
        prenatal: collectTableRowsInputField('prenatal-body'),
        //section C
        a1: collectTableRowsInputField('immun-a1-body'),
        a2: collectTableRowsInputField('immun-a2-body'),
        a3: collectTableRowsInputField('immun-a3-body'),
        a4: collectTableRowsInputField('immun-a4-body'),
        nutrition: collectTableRowsInputField('nutrition-body'),
        sick: collectTableRowsInputField('sick-body'),
        //section D
        oral: collectTableRowsInputField('oral-body'),
        //section E
        e1: collectTableRowsInputField('e1-body'),
        e2: collectTableRowsInputField('e2-body'),
        e3: collectTableRowsInputField('e3-body'),
        e4: collectTableRowsInputField('e4-body'),
        e5: collectTableRowsInputField('e5-body'),
        e6: collectTableRowsInputField('e6-body'),
        e7: collectTableRowsInputField('e7-body'),
        e8: collectTableRowsInputField('e8-body'),
        //section F
        waterBody: collectTableRowsInputField('f-water-body'),
        sanitationBody: collectTableRowsInputField('f-sanitation-body'),
        //section G
        filariasis: collectTableRowsInputField('g-filariasis-body'),
        rabies: collectTableRowsInputField('g-rabies-body'),
        schistosomiasis: collectTableRowsInputField('g-schistosomiasis-body'),
        sth: collectTableRowsInputField('g-sth-body'),
        leprosy: collectTableRowsInputField('g-leprosy-body'),
        hiv: collectTableRowsInputField('g-hiv-body'),
        //section H
        mortality: collectTableRowsInputField('vital-mortality-body'),
        natality: collectTableRowsInputField('vital-natality-body'),
    };

    try {
        const fetchSection = { section: s };
        const response = await fetch('../controller/fetchanalyticsdata.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(fetchSection)
        });

        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const result = await response.json();
        const b = Object.entries(result.message);//convert the json to array
        console.log("values: ", b);
        let r = 0;
        for (const [key, value] of Object.entries(textfields)) {
            let x = 0;
            const data = result.message[r];
            console.log(key, data);
            for (const [row, col] of Object.entries(value)) {
                //console.log(x);
                //iterate the fields and assign with the data
                const fields = Object.values(col);
                console.log('data',data);
                const dataValues = data.length > 0 ? Object.values(data[x]) : [];
                if (dataValues.length > 0) {  //if no returned data from database, do not override the fields
                    for (i = 0; i < fields.length; i++) {
                        const tf = document.querySelector("input[name=\"" + fields[i] + "\"]");
                        if (tf) {
                            let d = dataValues[i + 2];
                            if (!isNaN(d) && typeof d === 'number') {
                                d = parseInt(d);
                            }
                            if(d==null){
                                d=0;
                            }
                            tf.value = d;
                            //console.log(dataValues[i]);
                        }
                    }
                }
                x++;
            }
            r++;
        }
    } catch (error) {
        console.error('Error:', error);
    }


}