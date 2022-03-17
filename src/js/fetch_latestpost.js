document.readyState !== 'loading' ? fetch_latestPost() : document.addEventListener('DOMContentLoaded', () => fetch_latestPost());

function fetch_latestPost() {
	let postsDiv = '';
	max_pos = '';

	//find the div holding the post to check all is ok
	if (document.querySelector('.post-list')) {
		postsDiv = document.querySelector('.post-list');
		//get btn load more
		const btnLoadMore = document.querySelector('.load-more-post');
		btnLoadMore.addEventListener('click', () => fetchPost());
	}
}

/*   LOAD MORE JS */
function fetchPost() {
	current_page++;
	max_post = postsDiv.dataset.max;
	offset = postsDiv.dataset.offset;

	const url = `/wp-admin/admin-ajax.php?action=loadmore_posts`;
	const data = {
		current_page: current_page,
		offset: offset,
	};

	//FETCHING DATA BY XMLHttpRequest
	//startHttpRequest(url, data);
	fetchingRequest(url, data);
}

/* FETCHING DATA BY XMLHttpRequest*/
function fetchingRequest(url, data) {
	console.log(url, data, postsDiv);
	////CHECK IF I REACH THE MAX PAGES
	if (max_post <= current_page) {
		console.log('NO more post remove load more btn', max_post);
		return;
	} else {
		console.log('Keep going', max_post);
	}

	/*  METHOD 1 : FETCHING LATEST POST */
	fetch(url, {
		method: 'POST',
		headers: {
			'Content-Type': 'application/x-www-form-urlencoded',
		},
		body: JSON.stringify(data),
	})
		.then(response => response.text())
		.then(data => {
			const content = JSON.parse(data);
			postsDiv.insertAdjacentHTML('beforeend', content.data);
		})
		.catch(error => {
			console.error('Error:', error);
		});
}

/*  METHOD 2 : XMLHttpRequest LATEST POST */

function startHttpRequest(url, data) {
	if (!window.XMLHttpRequest) {
		alert('Your browser does not support the native XMLHttpRequest object.');
		return;
	}
	console.log('html', data);
	const oReq = new XMLHttpRequest();
	oReq.addEventListener('load', reqListener);
	oReq.addEventListener('error', transferFailed);
	oReq.open('POST', url, true);
	oReq.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	oReq.send(data);
}
function reqListener() {
	const content = JSON.parse(this.responseText);
	console.log(content.data);
	postsDiv.insertAdjacentHTML('beforeend', content.data);
}
function transferFailed(evt) {
	console.log('An error occurred while transferring the file.');
}
