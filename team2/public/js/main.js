let PART = document.getElementById('part-display');
let SYMPTOM = document.getElementById('symptom-display');
let DISEASE = document.getElementById('disease-display');
let MAP = document.getElementById('map-display');

function partCheck(index) {
	console.log(index);

	let formData = new FormData();
	formData.append('part_id', index);

	// console.log(formData.get('part_id'));
	fetch('/partselect', {
		method: 'POST',
		body: formData,
	})
	.then(response => response.json())
	.then(data => {
		console.log(data);
	})
	.catch(error => {
		console.error('오류 발생:', error);
	})
	
	PART.style.display = 'none';
	SYMPTOM.removeAttribute('display');
	SYMPTOM.style.display = 'block';
}

function symptomCheck(index) {
	SYMPTOM.style.display = 'none';
	DISEASE.removeAttribute('display');
	DISEASE.style.display = 'block';
}

function mapDisplay() {
	MAP.removeAttribute('display');
	MAP.style.display = 'block';
}

