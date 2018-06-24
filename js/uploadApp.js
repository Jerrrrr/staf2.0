(function(){

	//input form
	var uploadForm, submitButton, loadingIndicator;
	var imageInputEl, previewWrapperEl, imageErrorEl;


	//drag drop
	var dropZoneEl;
	var selectedFile;
	var counter = 0;
	

	function init() {
		uploadForm = document.querySelector('form.upload-form');
		if(uploadForm) {
			initUploadForm();
		}
	}

	function initUploadForm() {
		submitButton = uploadForm.querySelector('input[type=submit]');
		//insert loading indicator
		loadingIndicator = document.createElement('div');
		loadingIndicator.classList.add('loading-indicator-bar');
		loadingIndicator.innerHTML = '<div class="loading-indicator-bar-fill"></div>'
		loadingIndicator.style.display = 'none';
		submitButton.parentNode.appendChild(loadingIndicator);
		//listen for submit
		uploadForm.addEventListener('submit', uploadSubmitHandler);
		imageInputEl = document.querySelector('.form-input-image');
		if(imageInputEl) {
			initImageInput();
			//drag drop support?
			if('draggable' in document.createElement('span')) {
			  initDragDrop();
			}
		}
	}

	function initDragDrop() {
		document.documentElement.classList.add('has-drag-drop');
		//insert drop zone
		dropZoneEl = document.createElement('div');
		dropZoneEl.classList.add('drop-zone');
		dropZoneEl.innerHTML = '<div class="drop-zone-inner"><span class="drop-zone-label">Select Or Drop Image</span></div>';
		imageInputEl.parentNode.appendChild(dropZoneEl);
		//add listeners
		dropZoneEl.addEventListener("dragenter", dragenterHandler);
		dropZoneEl.addEventListener("dragover", dragoverHandler);
		dropZoneEl.addEventListener("dragleave", dragleaveHandler);
		dropZoneEl.addEventListener("drop", dropHandler);
	}

	function dragenterHandler(e) {
		e.preventDefault();
		counter++;
		dropZoneEl.classList.add('drag-over');
	}

	function dragoverHandler(e) {
		e.preventDefault();
	}

	function dragleaveHandler(e) {
		e.preventDefault();
		counter--;
		if(counter === 0) {
			dropZoneEl.classList.remove('drag-over');
		}
	}

	function dropHandler(e) {
		e.preventDefault();
		counter = 0;
		dropZoneEl.classList.remove('drag-over');
		var dt = e.dataTransfer;
  	var files = dt.files;
  	selectedFile = files[0];
  	previewSelectedFile();
	}

	function uploadSubmitHandler(event) {
		if(!validateImage()) {
			event.preventDefault();
			return;
		}
		if(window.FormData) {
			event.preventDefault();
			//ajax submit
			submitButton.style.display = 'none';
			loadingIndicator.style.display = 'block';
			//if it is handled through file input field, you could just do this:
			//var formData = new FormData(uploadForm);
			//but we might also select a file via drag / drop, so we have to do this:
			var formData = new FormData();
			formData.append('image', selectedFile, selectedFile.name);

			var req = new XMLHttpRequest();
			req.open('POST', uploadForm.getAttribute('action'));
			if(req.upload) {
				req.upload.onprogress = function(e) {
					if (e.lengthComputable) {
						var percentComplete = (e.loaded / e.total)*100; 
						displayProgress(percentComplete);
					}
				}
			} else {
				displayProgress(100);
			}
			req.onload = function() {
				var result = document.createElement('div');
				result.innerHTML = req.responseText;
				console.log(result);
				var updatedResult = result.querySelector('.result');
				var origResult = document.querySelector('.result');
				origResult.parentNode.replaceChild(updatedResult, origResult);
				submitButton.style.display = 'inline';
				loadingIndicator.style.display = 'none';
				previewWrapperEl.innerHTML = '';
				imageInputEl.value = null;
				selectedFile = null;
			}
			req.send(formData);
		}
	}

	function displayProgress(percentage) {
		//recalculate percentage, start at 10 so we always see "something"
		percentage = 10 + percentage * 0.9;
		loadingIndicator.querySelector('.loading-indicator-bar-fill').style.width = percentage + '%';
	}

	function initImageInput() {
		//file api is not supported below IE9, so we need to check if it is supported
		if(!window.File || !window.FileReader || !window.FileList || !window.Blob) {
			return;
		}
		//create extra DOM element for preview
		previewWrapperEl = document.createElement('div');
		previewWrapperEl.classList.add('preview-wrapper');
		imageInputEl.parentNode.insertBefore(previewWrapperEl, imageInputEl);
		//DOM element for error
		imageErrorEl = imageInputEl.parentNode.querySelector('.error');
		if(!imageErrorEl) {
			imageErrorEl = document.createElement('span');
			imageErrorEl.classList.add('error');
			imageInputEl.parentNode.appendChild(imageErrorEl, imageInputEl);
		}
		//bind change event
		imageInputEl.addEventListener('change', imageInputChangeHandler);
	}

	function displayImageError(err) {
		imageErrorEl.innerText = err;
		imageErrorEl.style.display = 'block';
	}

	function validateImage() {
		imageErrorEl.style.display = 'none';
		if(!selectedFile) {
			displayImageError('Please select an image');
			return false;
		}
		if(selectedFile.type.search('image') != 0) {
			displayImageError('The selected file is not an image');
			return false;
		}
		return true;
	}

	function imageInputChangeHandler(event) {
		previewWrapperEl.innerHTML = '';
		selectedFile = imageInputEl.files[0];
		if(validateImage()) {
			previewSelectedFile();
		}
	}

	function previewSelectedFile() {
		previewWrapperEl.innerHTML = '';
		var reader = new FileReader();
		reader.onload = function(event) {
			var img = document.createElement('img');
			img.onload = function() {
				if(img.width < 300 || img.height < 300) {
					imageErrorEl.innerText = 'The image needs to be at least 300x300';
					imageErrorEl.style.display = 'block';
				} else {
					previewWrapperEl.appendChild(img);
				}
			}
			img.setAttribute('src', reader.result);
		};
		reader.readAsDataURL(selectedFile);
	}



	init();
})();