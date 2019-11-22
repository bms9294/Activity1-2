var jsonData;
document.getElementById("uploadBtn").disabled = true;
document.getElementById("finalizeBtn").disabled = true;


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
	var description = document.getElementById("description").value;
	$.post("core/video/finalize.php", {"title": filename, "path": jsonData.path, "description": description});
}


function deleteVideo()
{
	$.post("core/video/deleteVideo.php", {"videoID": "2"});
}

function getVideoTitle()
{
	var fullPath = document.getElementById("fileUpload").value;
	var title = document.getElementById("filename").value;
	if (fullPath && title)
	{
		var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
		var filename = fullPath.substring(startIndex);
		if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
			filename = filename.substring(1);
		}
		document.getElementById("uploadFilename").textContent = filename;
	}


}

function checkifUploadValid()
{
	var title = document.getElementById("filename").value;
	var path = document.getElementById("fileUpload").value;
	if (((title != null) && (path != "")))
	{
		document.getElementById("uploadBtn").disabled = false;
		$('.uploadBtn').toggleClass('uploaded');

		document.getElementById("finalizeBtn").disabled = false;
		$('.finalizeBtn').toggleClass('finalized');

	}
}


document.getElementById("uploadBtn").addEventListener("click", uploadVideo);
document.getElementById("finalizeBtn").addEventListener("click", addVideoToDB);
//document.getElementById("deleteButton").addEventListener("click", deleteVideo);
$("#fileUpload").on("change", getVideoTitle);
$("#filename").on("change", checkifUploadValid);
$("#fileUpload").on("change", checkifUploadValid);
