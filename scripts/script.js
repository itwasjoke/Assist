
function go_reg(){
	f1=document.getElementById('auth1');
	f2=document.getElementById('auth2');
	f1.classList.add('hide');
	f2.classList.remove('hide');
 };
 function go_log(){
	f1=document.getElementById('auth1');
	f2=document.getElementById('auth2');
	f1.classList.remove('hide');
	f2.classList.add('hide');
 };
 function exit(){
 	// alert(1);
 	document.cookie = "id_user=; expires = Thu, 01 Jan 1970 00:00:00 GMT; path=/";
 	location.href = 'http://u99924i2.beget.tech/index.php';
 }
