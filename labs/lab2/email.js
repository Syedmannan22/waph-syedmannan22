var shown = false;
function showhideEmail(){
	if(shown){
		document.getElementById('email').innerHTML = "show my email";
		shown = false;
	}else{
		var myemail = "<a href='mailto:syeda45"+"@"+"udayton.edu'> syeda45"+"@"+"udayton.edu</a>";
		document.getElementById('email').innerHTML = myemail;
		shown = true;
	}
}