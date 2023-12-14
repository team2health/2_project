let PART = document.getElementById('part-display');
let SYMPTOM = document.getElementById('symptom-display');
let DISEASE = document.getElementById('disease-display');
let MAP = document.getElementById('map-display');

function partCheck(index) {
	console.log(index);
	PART.style.display = 'none';
	SYMPTOM.removeAttribute('display');
	SYMPTOM.style.display = 'block';
}

function symptomCheck(index) {
	console.log(index);
	SYMPTOM.style.display = 'none';
	DISEASE.removeAttribute('display');
	DISEASE.style.display = 'block';
}

function mapDisplay() {
	MAP.removeAttribute('display');
	MAP.style.display = 'block';
}

