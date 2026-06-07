async function displayFamilyPlanning() {
	try {
		const response = await fetch('../controller/analyticsview.php?action=family_planning', {
			method: 'GET',
			credentials: "same-origin",
			headers: { 'Content-Type': 'application/json' },
		});
		const result = await response.json();
		const l = result.indicator;
		const label = result.map(row => row.indicator);
		const current_begin = result.map(row => row.current_begin_total);
		const current_end = result.map(row => row.current_end_total);
		new Chart(document.getElementById("chartFamilyPlanning"), {
			type: 'line',
			data: {
				labels: label,
				datasets: [{
					data: current_begin,
					label: "Current Begin",
					borderColor: "#3CBA9F",
					fill: false
				},{
					data: current_end,
					label: "Current End",
					borderColor: "#E43202",
					fill: false
				}]
			},
			options:{
				title:{
					display:true,
					text:"Current Begin vs Current End"
				}
			}
		});
	} catch (err) {
		console.error(err);
	}
}
async function displayPrenatalServices(){
try {
		const response = await fetch('../controller/analyticsview.php?action=prenatal_services', {
			method: 'GET',
			credentials: "same-origin",
			headers: { 'Content-Type': 'application/json' },
		});
		const result = await response.json();
		const label = result.map(row => row.indicator);
		const total = result.map(row => row.total);
		console.log('label: ',label);
		new Chart(document.getElementById("chartPrenatalServices"), {
			type: 'bar',
			data: {
				labels: label,
				datasets: [{
					data: total,
					label: "Prenatal Totals",
					backgroundColor: "#3CBA9F"
				}]
			},
			options:{
				title:{
					display:true,
					text:"Prenatal Services Totals"
				}
			}
		});
	} catch (err) {
		console.error(err);
	}
}
async function displayImmunization(){
try {
		const response = await fetch('../controller/analyticsview.php?action=immunization', {
			method: 'GET',
			credentials: "same-origin",
			headers: { 'Content-Type': 'application/json' },
		});
		const result = await response.json();
		const label = result.map(row => row.indicator);
		const total = result.map(row => row.total);
		console.log('label: ',label);
		new Chart(document.getElementById("chartImmunization"), {
			type: 'bar',
			data: {
				labels: label,
				datasets: [{
					data: total,
					label: "Immunization Totals",
					backgroundColor: "#3CBA9F"
				}]
			},
			options:{
				title:{
					display:true,
					text:"Immunization Summary"
				}
			}
		});
	} catch (err) {
		console.error(err);
	}
}
async function displayNutrition(){
try {
		const response = await fetch('../controller/analyticsview.php?action=nutrition', {
			method: 'GET',
			credentials: "same-origin",
			headers: { 'Content-Type': 'application/json' },
		});
		const result = await response.json();
		console.log("nutrition: ",result);
		const label = result.map(row => row.indicator);
		const total = result.map(row => row.total);
		new Chart(document.getElementById("chartNutrition"), {
			type: 'bar',
			data: {
				labels: label,
				datasets: [{
					data: total,
					label: " Nutrition",
					backgroundColor: "#3CBA9F"
				}]
			},
			options:{
				title:{
					display:true,
					text:"Nutrition Summary"
				}
			}
		});
	} catch (err) {
		console.error(err);
	}
}
async function displaySickChild(){
try {
		const response = await fetch('../controller/analyticsview.php?action=sick_child', {
			method: 'GET',
			credentials: "same-origin",
			headers: { 'Content-Type': 'application/json' },
		});
		const result = await response.json();
		console.log("sickhild: ",result);
		const label = result.map(row => row.indicator);
		const total = result.map(row => row.total);
		new Chart(document.getElementById("chartSickChild"), {
			type: 'bar',
			data: {
				labels: label,
				datasets: [{
					data: total,
					label: " Sick Management",
					backgroundColor: "#3CBA9F"
				}]
			},
			options:{
				title:{
					display:true,
					text:"Sick Child Management"
				}
			}
		});
	} catch (err) {
		console.error(err);
	}
}
async function displayOralHealthServices(){
try {
		const response = await fetch('../controller/analyticsview.php?action=oral_health', {
			method: 'GET',
			credentials: "same-origin",
			headers: { 'Content-Type': 'application/json' },
		});
		const result = await response.json();
		console.log("OHS: ",result);
		const label = result.map(row => row.indicator);
		const total = result.map(row => row.total);
		new Chart(document.getElementById("chartOralHealthServices"), {
			type: 'bar',
			data: {
				labels: label,
				datasets: [{
					data: total,
					label: "Oral Health",
					backgroundColor: "#3CBA9F"
				}]
			},
			options:{
				title:{
					display:true,
					text:"Oral Health Services"
				}
			}
		});
	} catch (err) {
		console.error(err);
	}
}

async function displayNCD(){
try {
		const response = await fetch('../controller/analyticsview.php?action=ncd', {
			method: 'GET',
			credentials: "same-origin",
			headers: { 'Content-Type': 'application/json' },
		});
		const result = await response.json();
		console.log("NCD: ",result);
		const label = result.map(row => row.indicator);
		const total = result.map(row => row.total);
		new Chart(document.getElementById("chartNCD"), {
			type: 'radar',
			data: {
				labels: label,
				datasets: [{
					data: total,
					label: "Lifestyle Risk",
					backgroundColor: "#3CBA9F"
				}]
			},
			options:{
				title:{
					display:true,
					text:"Lifestyle Risk (NCD)"
				}
			}
		});
	} catch (err) {
		console.error(err);
	}
}

async function displayNCD(){
try {
		const response = await fetch('../controller/analyticsview.php?action=ncd', {
			method: 'GET',
			credentials: "same-origin",
			headers: { 'Content-Type': 'application/json' },
		});
		const result = await response.json();
		console.log("NCD: ",result);
		const label = result.map(row => row.indicator);
		const total = result.map(row => row.total);
		new Chart(document.getElementById("chartNCD"), {
			type: 'radar',
			data: {
				labels: label,
				datasets: [{
					data: total,
					label: "Lifestyle Risk",
					backgroundColor: "#3CBA9F"
				}]
			},
			options:{
				title:{
					display:true,
					text:"Lifestyle Risk (NCD)"
				}
			}
		});
	} catch (err) {
		console.error(err);
	}
}

async function displayNatality(){
try {
		const response = await fetch('../controller/analyticsview.php?action=vital_statistics', {
			method: 'GET',
			credentials: "same-origin",
			headers: { 'Content-Type': 'application/json' },
		});
		const result = await response.json();
		console.log("Natality: ",result);
		const label = result.map(row => row.indicator);
		const total = result.map(row => row.total);
		new Chart(document.getElementById("chartNatality"), {
			type: 'line',
			data: {
				labels: label,
				datasets: [{
					data: total,
					label: "Lifestyle Risk",
					backgroundColor: "red",
					borderColor:"#3CBA9F"
				}]
			},
			options:{
				title:{
					display:true,
					text:"Lifestyle Risk (NCD)"
				}
			}
		});
	} catch (err) {
		console.error(err);
	}
}
displayFamilyPlanning();
displayPrenatalServices();
displayImmunization();
displayNutrition();
displaySickChild();
displayOralHealthServices();
displayNCD();
displayNatality();