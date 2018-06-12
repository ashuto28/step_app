

function getQuestion(divID,questionNo){
	var ques = document.getElementById('questionNo');
	ques.innerHTML=questionNo;
	question=questionNo;
	var XMLHttpRequestObject=false;

	if(window.XMLHttpRequest){
	XMLHttpRequestObject = new XMLHttpRequest();
	}
	else if(window.ActiveXObject){
		XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
	}
			
	if(XMLHttpRequestObject){

		var obj = document.getElementById(divID);
		XMLHttpRequestObject.open("GET","getQuestion.php?ques="+questionNo);
		XMLHttpRequestObject.onreadystatechange = function()
		{
			if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200){
				obj.innerHTML=XMLHttpRequestObject.responseText;
			
		
			}
		}
		XMLHttpRequestObject.send(null);
		
		
	}
	
	
}
