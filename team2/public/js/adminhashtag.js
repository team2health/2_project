function insertHashtag() {
	let INSERTHASHTAG = document.getElementById('insert_hashtag').value;

	let formData = new FormData();
	formData.append('hashtag_name', INSERTHASHTAG);

	fetch('/hashtaginsert', {
		method: 'POST',
		body: formData,
	})
	.then(response => response.json())
	.then(data => {
		console.log(data);
		let HASHTAGBODY = document.getElementById('hashtagbody');
		let HASHTAG = document.createElement('tr');
		let INPUTHASHTAGBOX = document.createElement('th');
		let INPUTHASHTAG = document.createElement('input');
		let HASHTAGNAME = document.createElement('td')
		let HASHTAGBOARD = document.createElement('td');
		let HASHTAGFAVORITE = document.createElement('td');
		let HASHTAGCREATE = document.createElement('td');

		INPUTHASHTAGBOX.scope = 'row';
		INPUTHASHTAG.type = 'checkbox';
		INPUTHASHTAG.name = 'hashtag_id[]';
		INPUTHASHTAG.value = data.hashtag_id;
		HASHTAGNAME.innerHTML = data.hashtag_name;
		HASHTAGBOARD.innerHTML = data.board_hashtag+'번 사용';
		HASHTAGFAVORITE.innerHTML = data.favorite_hashtag+'번 사용';

		let DATE = new Date(data.created_at);
		var formattedDate = DATE.getFullYear() + '-' +
        ('0' + (DATE.getMonth() + 1)).slice(-2) + '-' +
        ('0' + DATE.getDate()).slice(-2) + ' ' +
        ('0' + DATE.getHours()).slice(-2) + ':' +
        ('0' + DATE.getMinutes()).slice(-2) + ':' +
        ('0' + DATE.getSeconds()).slice(-2);

		HASHTAGCREATE.innerHTML = formattedDate;

		HASHTAGBODY.prepend(HASHTAG);
		HASHTAG.appendChild(INPUTHASHTAGBOX);
		INPUTHASHTAGBOX.appendChild(INPUTHASHTAG);
		HASHTAG.appendChild(HASHTAGNAME);
		HASHTAG.appendChild(HASHTAGBOARD);
		HASHTAG.appendChild(HASHTAGFAVORITE);
		HASHTAG.appendChild(HASHTAGCREATE);

		document.getElementById('insert_hashtag').value = "";
	})
	.catch(error => {
		console.error(error.stack);
	})
}