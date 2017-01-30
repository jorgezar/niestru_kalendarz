<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link rel='stylesheet' href='css/template.css' />
<link rel='stylesheet' href='css/font-awesome.css' />
<script src='js/jquery-3.1.1.min.js'></script>
<script src='js/jquery-ui.min.js'></script>
<script src='js/modernizr.js'></script>
<meta name=viewport content="width=device-width, initial-scale=1">
</head>



<script type="text/javascript">
//<![CDATA[
$(document).ready(function(){
  $('.menu-left').click(function(){
    $('header').toggleClass('active')
    $('.intro').toggleClass('active')
    $('section').toggleClass('active')
    $('#menu-left').toggleClass('active')
    $('footer').toggleClass('active')
  })
  $('.menu-right').click(function(){$('#menu-right').toggleClass('active')})
});
//]]>
</script>


<topik></topik>


<header>
  <span class="menu-left"><i class="fa fa-navicon"></i></span>
	
	<span class="menu-callendr"><a href="callendar.php"><i class="fa fa-calendar"></i> Kalendarz</a></span>

  <span class="menu-right"><i class="fa fa-sign-in"></i> Zaloguj</span>
	
</header>
<div id="menu-left">
  <div class="box">
    <div class="profile">
      <img src="https://mikemonaco.files.wordpress.com/2009/11/3ehalforc.jpg?w=470" alt="" /><span>ORG BARBARIAN</span>
    </div>
    <div class="content">
    <h5>Menu</h5>
    <ul>
      <li><a href="/niestru/"><i class="fa fa-home"></i> Home</a></li>
      <li><a href="cennik.php"><i class="fa fa-credit-card"></i> Cennik</a></li>
      <li><a href="faq.php"><i class="fa fa-question-circle"></i> FAQ</a></li>
      <li><a href="opinie.php"><i class="fa fa-comment"></i> Opinie</a></li>
    </ul>
    <h5>Kontakt</h5>
    <ul>
      <li><i class="fa fa-phone-square"></i>+48 795 797 259</li>
      <li><i class="fa fa-phone-square"></i> +48 660 962 041</li>
      <li><a href=""mailto: adres e-mail"><i class="fa fa-envelope"></i> adres@mail.pl</a></li>
    </ul>
   </div>
  </div>
</div>
<div id="menu-right">
  <div class="box">
    <ul>
				<li><?php include_once("modules/login/login.php");?>
    </ul>
  </div>
</div>


</html>