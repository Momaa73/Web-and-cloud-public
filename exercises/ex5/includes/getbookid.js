function showData(data) {

	const ulFrag = document.createDocumentFragment();	
	for (const key in data.category){
		const li = document.createElement('li');
		sHtml = `<a class="dropdown-item" href='index.php?category="${data.category[key]}"'>${data.category[key]}</a>`;
		li.innerHTML = sHtml;
		ulFrag.appendChild(li);
	} 	
	document.getElementById("dropmenu").appendChild(ulFrag);
	
}

fetch("data/category.json")
	.then(response => response.json())
	.then(data => showData(data));
	