var jsonData;
var videoUploaded;
document.getElementById("uploadBtn").disabled = true;
document.getElementById("finalizeBtn").disabled = true;


function progressFunction(evt){  
	var progressBar = document.getElementById("progressBar");  
	var percentageDiv = document.getElementById("percentageCalc");  
	 if (evt.lengthComputable) {  
	   progressBar.max = evt.total;  
	   progressBar.value = evt.loaded;  
	   percentageDiv.innerHTML = Math.round(evt.loaded / evt.total * 100) + "%";  
	 }  
}  

function startUpload() {
	document.getElementById("uploadBtn").disabled = true;
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
			document.getElementById("finalizeBtn").disabled = false;
			videoUploaded = true;
			checkifFinalizeValid();
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
	if(!filename.includes("\"")) filename = "\""+document.getElementById("filename").value+"\"";
	$.post("core/video/finalize.php", {"title": filename, "path": jsonData.path, "description": description}).done(function (data) {
		var result = JSON.parse(data);
		if (result.success)
		{
			document.location.assign("/")
		}
	});
}



function getVideoTitle()
{
	var fullPath = document.getElementById("fileUpload").value;

	if (fullPath)
	{
		var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
		var filename = fullPath.substring(startIndex);
		if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
			filename = filename.substring(1);
		}

		if(filename.length > 53)
		{
			document.getElementById("uploadFilename").textContent = filename.substring(0, 50) + "...";
		}
		else
		{
			document.getElementById("uploadFilename").textContent = filename;
		}

	}


}

function checkifUploadValid()
{
	var path = document.getElementById("fileUpload").value;
	if ((path != null))
	{
		document.getElementById("uploadBtn").disabled = false;
		$('.uploadBtn').toggleClass('uploaded');
	}
}

function checkifFinalizeValid()
{
	var title = document.getElementById("filename").value;
	if (((title.length > 0) && (videoUploaded == true)))
	{
		$('.finalizeBtn').toggleClass('finalized');
	}
}

function downloadVideo()
{
	document.getElementById("downloadStatus").textContent = "Download in progress...";
	var url = document.getElementById("downloadURL").value;
	var title = document.getElementById("filename").value;
	$.post("core/video/downloadVideo.php", {"url": url, "title": title}).done(function (data) {
		jsonData = JSON.parse(data);
		if (jsonData.success)
		{
			document.getElementById("downloadStatus").textContent = "Download to server complete!";
			document.getElementById("finalizeBtn").disabled = false;	
		}
		else
		{
			document.getElementById("downloadStatus").textContent = "Download to server failed!";
		}
	});
}

function checkifDownloadValid()
{
	var url = document.getElementById("downloadURL").value;
	if (url.length > 1)
	{
		$('.downloadBtn').toggleClass('finalized');
	}
}


document.getElementById("downloadBtn").addEventListener("click", downloadVideo);
document.getElementById("uploadBtn").addEventListener("click", uploadVideo);
document.getElementById("finalizeBtn").addEventListener("click", addVideoToDB);
$("#fileUpload").on("change", getVideoTitle);
$("#filename").on("change", checkifFinalizeValid);
$("#fileUpload").on("change", checkifUploadValid);
$("#downloadURL").on("change", checkifDownloadValid);