function submitFile(){
	var value=editor.getValue();
	var XMLHttpRequestObject=false;
	if(window.XMLHttpRequest){
	XMLHttpRequestObject = new XMLHttpRequest();
	}
	else if(window.ActiveXObject){
		XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
	}
	if(XMLHttpRequestObject){
		XMLHttpRequestObject.open("POST","main/compile.php");
		XMLHttpRequestObject.setRequestHeader('content-type','application/x-www-form-urlencoded');
	
		XMLHttpRequestObject.onreadystatechange = function()
		{
			if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200){
				
			var	data=XMLHttpRequestObject.responseText;
				
				swal({
				  title: "StepApp Coding Arena",
				  text: "You can Submit your code as many time you want. Only last submitted code is considerred for evaluation",
				  type: "info",
				  closeOnConfirm: false,
				  showLoaderOnConfirm: true,
				},
				function(){
				  setTimeout(function(){
					if (data==true) {
					swal("CONGRATS!", "Submission Successfull.You have passed all testcases", "success");}
				  else if(data==false) {
					swal("FAILED!", "Your code can not be Submitted. Failed in one or more testcases", "error");}
				  else {
					swal("FAILED!", data, "error");}
				  
				  }, 2000);
				});
				
			}
		}
		XMLHttpRequestObject.send("value="+value);
	}
}