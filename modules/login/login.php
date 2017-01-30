<div class='login' id='loginWidget'>
<?php 
include_once("/var/www/html/niestru_kalendarz/callendar/database/connection.php");
if(isset($_SESSION['user'])){
	$user = $_SESSION['user'];
	echo 'Witaj, ' . $user . "!";
	echo "<span><input type =''button' value='wyloguj się' ></span>";
} else {
	$login = "";
	$signin = "";
}
?>
<script>
$(document).ready(function(){

$("#showSigninPanel").on('click', function(){
	$("#signinPanel").dialog({
		dialogClass : "loginDialog",
		modal : true,
		title : "nowe konto",
		buttons : {
			"Załóż konto" : function(){
				var errors = [];
				var nameValid = false;
				var passwordValid = false;
				var emailValid = false;
				var passwordMatch = false;
				var username = $("#newUserName").val();
				var usermail = $("#newUserEmail").val();
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
					//pass data to php script
					$.ajax({
						type : "POST",
						url : "http://easypack1.hekko24.pl/niestru/callendar/database/user/userCreate.php",
						data : {
							'username' : username,
							'useremail' : usermail,
							'password' : password1
						},
						success : function(result){
							alert(result);
							//alert("Pod podany adres wyślemy link aktywacyjny.");
						}
					});
				} else {
					alert(errors);
				}
			}
		}
	});
});
});
</script>


<div id="loginPanel">
	
	<form action="" method="post">
		
		<div class="loginArea">
		<label>Imię:</label>
		<input id="userLoginName" placeholder="imię" type="text">
		</div>
		
		<div class="loginArea">
		<label>Hasło :</label>
		<input id="userLoginPassword" placeholder="**********" type=	"password">
		</div>
		
		<input id="userLoginSubmit" type="submit" value="Zaloguj" />
		
	</form>
	<div class="right">
    <div class="connect">Połącz przez:</div>
    <a href="" class="facebook">
      
    </a> <br />
    <a href="" class="twitter">
      
    </a> <br />
    <a href="" class="google-plus">
      
    </a>
  </div>
</div>
<a href="newaccount.php"><span id='showSigninPanel'>Nowe konto</span></a>

</div>