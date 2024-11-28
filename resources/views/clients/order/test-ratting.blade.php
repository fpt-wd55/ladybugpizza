<div class="w-full h-screen bg-white">
    <div class="container mx-auto h-full flex flex-col justify-center items-center">
        <div id="images-container"></div>
        <div class="flex w-full justify-center">
            <div id="multi-upload-button"
                class="inline-flex items-center px-4 py-2 bg-gray-600 border border-gray-600 rounded-l font-semibold cursor-pointer text-sm text-white tracking-widest hover:bg-gray-500 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition ">
                Click to browse
            </div>
            <div class="w-4/12 lg:w-3/12 border border-gray-300 rounded-r-md flex items-center justify-between">
                <span id="multi-upload-text" class="p-2"></span>
                <button id="multi-upload-delete" class="hidden" onclick="removeMultiUpload()">
                    x
                </button>
            </div>
        </div>
        <input type="file" id="multi-upload-input" class="hidden" multiple />
    </div>
</div>

<script>
    //all ids and some classes are importent for this script

    multiUploadButton = document.getElementById("multi-upload-button");
    multiUploadInput = document.getElementById("multi-upload-input");
    imagesContainer = document.getElementById("images-container");
    multiUploadDisplayText = document.getElementById("multi-upload-text");
    multiUploadDeleteButton = document.getElementById("multi-upload-delete");

    multiUploadButton.onclick = function() {
        multiUploadInput.click(); // this will trigger the click event
    };

    multiUploadInput.addEventListener('change', function(event) {

        if (multiUploadInput.files) {
            let files = multiUploadInput.files;

            // show the text for the upload button text filed
            multiUploadDisplayText.innerHTML = files.length + ' files selected';

            // removes styles from the images wrapper container in case the user readd new images
            imagesContainer.innerHTML = '';
            imagesContainer.classList.remove("w-full", "grid", "grid-cols-1", "sm:grid-cols-2",
                "md:grid-cols-3", "lg:grid-cols-4", "gap-4");

            // add styles to the images wrapper container
            imagesContainer.classList.add("w-full", "grid", "grid-cols-1", "sm:grid-cols-2", "md:grid-cols-3",
                "lg:grid-cols-4", "gap-4");

            // the delete button to delete all files
            multiUploadDeleteButton.classList.add("z-100", "p-2", "my-auto");
            multiUploadDeleteButton.classList.remove("hidden");

            Object.keys(files).forEach(function(key) {

                let file = files[key];

                // the FileReader object is needed to display the image
                let reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function() {

                    // for each file we create a div to contain the image
                    let imageDiv = document.createElement('div');
                    imageDiv.classList.add("h-64", "mb-3", "w-full", "p-3", "rounded-lg",
                        "bg-cover", "bg-center");
                    imageDiv.style.backgroundImage = 'url(' + reader.result + ')';
                    imagesContainer.appendChild(imageDiv);
                }
            })
        }
    })

    function removeMultiUpload() {
        imagesContainer.innerHTML = '';
        imagesContainer.classList.remove("w-full", "grid", "grid-cols-1", "sm:grid-cols-2", "md:grid-cols-3",
            "lg:grid-cols-4", "gap-4");
        multiUploadInput.value = '';
        multiUploadDisplayText.innerHTML = '';
        multiUploadDeleteButton.classList.add("hidden");
        multiUploadDeleteButton.classList.remove("z-100", "p-2", "my-auto");
    }
</script>
