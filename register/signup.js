const form = document.querySelector(".signup form"),
continueBtn = form.querySelector(".button input"),
errorText = form.querySelector(".error-txt");

form.onsubmit = (e)=>{
	e.preventDefault(); //prevents form from submitting
}

continueBtn.onclick = ()=>{
	//starting Ajax
	let xhr = new XMLHttpRequest(); //creating XML Object
	xhr.open("POST", "php/signup.php", true);
	xhr.onload = ()=>{
		if(xhr.readyState === XMLHttpRequest.DONE){
			if(xhr.status === 200){
				let data = xhr.response;
				if(data == "success"){
					location.href = "users.php";
				}
				else{
					errorText.textContent = data;
					errorText.style.display = "block";
					
				}
			}
		}
	}
	
	// sending form data through ajax to php
	let formData = new FormData(form); //creating new formData Object
	xhr.send(formData); //sends the form data to php
}