<?php include("modules/header/header.html") ?>
<?php include('modules/menu/menulog.php'); ?>	
<span><h3>Już dzisiaj zacznij korzystać z naszego systemu zarządzania rezerwacjami!</h3></span>
<p>Wypełnij poniższy formularz, a my prześlemy na twój adres email wiadmość z linkiem aktywacyjnym i dalszymi instrukcjami.</p>
<div id='showSignInErrors'></div>
<div id ='signinPanel' >
		<label>Imię: </label>
		<input id='newUserName' placeholder='imię' type='text'></br>
		<label>Email: </label>
		<input id='newUserEmail' placeholder='email' type='text'></br>
		<label>telefon: </label>
		<input id='newUserTelephone' placeholder='123456789' type='number'></br>
		<label>Hasło: </label>
		<input id='newUserPass1' placeholder='********' type='password'></br>
		<label>Powtórz Hasło: </label>
		<input id='newUserPass2' placeholder='********' type='password'></br>
		<span id='createNewAccount'><button>Załóż konto</button></span>
</div>
<a href='index.php'><button>Powrót na główną</button></a>
<script>
$(document).ready(function(){
	$("#createNewAccount").on('click', function(){
		var errors = [];
		var nameValid = false;
		var passwordValid = false;
		var emailValid = false;
		var passwordMatch = false;
		var username = $("#newUserName").val();
		var usermail = $("#newUserEmail").val();
		var usertelephone = $("#newUserTelephone").val();
		var password1 = $("#newUserPass1").val();
		var password2 = $("#newUserPass2").val();
		if(username.length >2 || username.length < 16){
			nameValid = true;
		} else {
			errors.push("Imię zbyt krótkie lub zbyt długie");
		}
		if(usermail.length > 5) {
			emailValid = true;
		} else {
			errors.push("nieodpowiedni email");
		}
		if(password1 === password2){
			passwordMatch = true;
		} else {
			errors.push("Hasła nie są tożsame");
		}
		if(password1.length >= 6){
			passwordValid = true;
		} else {
			errors.push("hasło musi mieć min 6 znaków");
		}
		if(nameValid && passwordValid && emailValid && passwordMatch){
			alert("form data valid");
			var newUserData = {
							'usertelephone' : usertelephone,
							'username' : username,
							'useremail' : usermail,
							'password' : password1
						};
					//pass data to php script
			$.ajax({
				type : "POST",
				url : "/niestru_kalendarz/callendar/database/user/userCreate.php",
				data : {
					'task' : 'userCreate',
					'userData' : newUserData
				},
				success : function(result){
					alert(result);
					}
				});
			} else {
					var errorsList = $("#showSignInErrors")
					$.each(errors, function(i){
						var item = $("<li/>")
							.addClass("signinError")
							.text(errors[i])
							.appendTo(errorsList);
					});
				}
	});
});
</script>
<?php include('footer.php'); ?>	
</body>

</html><style>
input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
input[type="number"] {
    -moz-appearance: textfield;
}
</style>