var jsonData;

function progressFunction(evt){  
	var progressBar = document.getElementById("progressBar");  
	//var percentageDiv = document.getElementById("percentageCalc");  
	 if (evt.lengthComputable) {  
	   progressBar.max = evt.total;  
	   progressBar.value = evt.loaded;  
	   //percentageDiv.innerHTML = Math.round(evt.loaded / evt.total * 100) + "%";  
	 }  
}  

function startUpload() {
	
}

function endUpload(data) {
	//var test = data.response;
	//alert(test);

}

function uploadVideo()
{

	var filename = $('#filename').val();
	var filesToBeUploaded = document.getElementById("fileUpload");  
	var file = filesToBeUploaded.files[0];  
	var xhrObj = new XMLHttpRequest();  



	xhrObj.upload.addEventListener("loadstart", startUpload, false);  
	xhrObj.upload.addEventListener("progress", progressFunction, false);  
	xhrObj.upload.addEventListener("load", endUpload, false);  

	xhrObj.onreadystatechange = function() {
		if (xhrObj.readyState == XMLHttpRequest.DONE) {
			jsonData = JSON.parse(xhrObj.responseText);
		}
	}

	xhrObj.open("POST", "core/video/videoUpload.php", true);  
	var form_data = new FormData();
	form_data.append("filename", filename);
	form_data.append("file", file);
	xhrObj.send(form_data);   

}

function addVideoToDB()
{
	var filename = document.getElementById("filename").value;
	$.post("core/video/finalize.php", {"title": filename, "path": jsonData.path});
}


document.getElementById("uploadBtn").addEventListener("click", uploadVideo);
document.getElementById("finalizeBtn").addEventListener("click", addVideoToDB);
