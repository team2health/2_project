function insertHashtag() {
	let INSERTHASHTAG = document.getElementById('insert_hashtag').value;

	let formData = new FormData();
	formData.append('hashtag_name', INSERTHASHTAG);

	fetch('/admin/hashtaginsert', {
		method: 'POST',
		body: formData,
	})
	.then(response => response.json())
	.then(data => {
		let HASHTAGBODY = document.getElementById('hashtagdeletebox');
		let HASHTAGHEADER = document.createElement('div');
		let HASHTAG = document.createElement('div');
		let HASHTAGDIV = document.createElement('div');
		let INPUTHASHTAGBOX = document.createElement('span');
		let INPUTHASHTAG = document.createElement('input');
		let HASHTAGNAME = document.createElement('span')
		let HASHTAGBOARD = document.createElement('span');
		let HASHTAGFAVORITE = document.createElement('span');
		let HASHTAGCREATE = document.createElement('span');

		// <div class="card-header">
		// 	<div class="admin-index-ps">
		// 		<div class="hashtagnsbox">
		// 			<span><input type="checkbox" name="pandemic_id[]" value="{{$item->hashtag_id}}"></span>
		// 			<span class="pandemic-name1">{{$item->hashtag_name}}</span>
		// 			<span class="pandemic-symptom1 hashtag-margin-right">{{$item->board_hashtag}}번 사용</span>
		// 			<span class="pandemic-symptom1 hashtag-margin-right">{{$item->favorite_hashtag}}번 사용</span>
		// 		</div>
		// 		<span>{{$item->created_at}}</span>
		// 	</div>
		// </div>

		HASHTAGHEADER.classList = 'card-header';
		HASHTAGHEADER.style.backgroundColor = '#f8f9fa';
		HASHTAG.classList = 'admin-index-ps';
		HASHTAGDIV.classList = 'hashtagnsbox';
		INPUTHASHTAG.type = 'checkbox';
		INPUTHASHTAG.name = 'hashtag_id[]';
		INPUTHASHTAG.value = data.hashtag_id;
		HASHTAGNAME.classList = 'pandemic-name1';
		HASHTAGBOARD.classList.add('pandemic-symptom2', 'hashtag-margin-right');
		HASHTAGFAVORITE.classList.add('pandemic-symptom2', 'hashtag-margin-right');
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

		HASHTAGBODY.prepend(HASHTAGHEADER);
		HASHTAGHEADER.appendChild(HASHTAG);
		HASHTAG.appendChild(HASHTAGDIV);
		HASHTAGDIV.appendChild(INPUTHASHTAGBOX);
		INPUTHASHTAGBOX.appendChild(INPUTHASHTAG);
		HASHTAGDIV.appendChild(HASHTAGNAME);
		HASHTAGDIV.appendChild(HASHTAGBOARD);
		HASHTAGDIV.appendChild(HASHTAGFAVORITE);
		HASHTAG.appendChild(HASHTAGCREATE);

		document.getElementById('insert_hashtag').value = "";
	})
	.catch(error => {
		console.error(error.stack);
	})
}

function hashtagdelete() {
    let checkboxes = document.querySelectorAll('input[name="hashtag_id[]"]');
    let chkflg = false;

    checkboxes.forEach(function(checkbox) {
        if(checkbox.checked === true) {
            chkflg = true;
        }
    });
    if(chkflg === false) {
        alert('선택된 해시태그가 없습니다.');
        return false;
    }
    document.getElementById('hashtagdeletebox').submit();
}