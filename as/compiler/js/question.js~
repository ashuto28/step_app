
var XMLHttpRequestObject=false;

if(window.XMLHttpRequest){
XMLHttpRequestObject = new XMLHttpRequest();
}
else if(window.ActiveXObject){
	XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
}

function getDatatextarea(language){
	var data="";
	
	if(XMLHttpRequestObject){
		if(language==="text/x-c++src"){
			language="cpp";
		}
		XMLHttpRequestObject.open("GET","data.php?language="+language);

		XMLHttpRequestObject.onreadystatechange = function()
		{
			if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200){
				
				data=XMLHttpRequestObject.responseText;
				callfun(data);
			}
		}
		XMLHttpRequestObject.send(null);
	}
}

function getData(divID){
			if(question<max)
				++question;
		//showQuestionNo();
	if(XMLHttpRequestObject){
		var obj = document.getElementById(divID);
		XMLHttpRequestObject.open("GET","nextQuestion.php?ques="+question);
		XMLHttpRequestObject.onreadystatechange = function()
		{
			if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200){
				obj.innerHTML=XMLHttpRequestObject.responseText;
				var ques = document.getElementById('questionNo');
					ques.innerHTML=question;
			}
		}
		XMLHttpRequestObject.send(null);
	}
}
function prevData(divID){
			if(question>1)
				--question;
		//showQuestionNo();
	if(XMLHttpRequestObject){
		var obj = document.getElementById(divID);
		XMLHttpRequestObject.open("GET","prevQuestion.php?ques="+question);
		XMLHttpRequestObject.onreadystatechange = function()
		{
			if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200){
				obj.innerHTML=XMLHttpRequestObject.responseText;
				var ques = document.getElementById('questionNo');
					ques.innerHTML=question;		
		
			}
		}
		XMLHttpRequestObject.send(null);
	}
}

