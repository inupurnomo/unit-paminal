const boxes = document.querySelectorAll('.box');
const fileInputs = document.querySelectorAll('input[type="file"]');
const selectButtons = document.querySelectorAll('label strong');
const fileLists = document.querySelectorAll('.file-list');

let droppedFiles = [];

// Loop through each box
boxes.forEach((box, index) => {
    const fileInput = fileInputs[index];
    const fileList = fileLists[index];

    // Remove 'multiple' attribute to only allow one file
    fileInput.removeAttribute('multiple');

    [ 'drag', 'dragstart', 'dragend', 'dragover', 'dragenter', 'dragleave', 'drop' ].forEach(event => {
        box.addEventListener(event, function(e) {
            e.preventDefault();
            e.stopPropagation();
        }, false);
    });

    [ 'dragover', 'dragenter' ].forEach(event => {
        box.addEventListener(event, function(e) {
            box.classList.add('is-dragover');
        }, false);
    });

    [ 'dragleave', 'dragend', 'drop' ].forEach(event => {
        box.addEventListener(event, function(e) {
            box.classList.remove('is-dragover');
        }, false);
    });

    box.addEventListener('drop', function(e) {
        droppedFiles = e.dataTransfer.files;
        
        // Ensure only one file is allowed
        if (droppedFiles.length > 1) {
            // sweetalert
            Swal.fire({
              icon: 'warning',
              title: 'Warning',
              text: 'Hanya boleh memilih 1 file.',
              customClass: {
                confirmButton: 'btn btn-success'
              }
            });
            // alert('You can only upload one file.');
            return;
        }
        
        fileInput.files = droppedFiles;
        updateFileList(fileInput, fileList);
    }, false);

    fileInput.addEventListener('change', function() {
        if (fileInput.files.length > 1) {
            // sweetalert
            Swal.fire({
              icon: 'warning',
              title: 'Warning',
              text: 'Hanya boleh memilih 1 file.',
              customClass: {
                confirmButton: 'btn btn-success'
              }
            });
            // alert('You can only select one file.');
            fileInput.value = ''; // Clear the file input if more than one file is selected
            return;
        }
        updateFileList(fileInput, fileList);
    });
});

// Function to update the file list for each input and add delete button
function updateFileList(fileInput, fileList) {
    const filesArray = Array.from(fileInput.files);
    if (filesArray.length == 1) {
        // Display the file and add a remove button
        fileList.innerHTML = `<div><p>Selected file: ${filesArray[0].name}</p><a href="javascript:void(0);" class="remove-btn">Remove</a></div>`;
        
        // Add event listener to remove button
        const removeBtn = fileList.querySelector('.remove-btn');
        removeBtn.addEventListener('click', function() {
            // Clear the file input and file list
            fileInput.value = '';
            fileList.innerHTML = '';
        });
    } else {
        fileList.innerHTML = '';
    }
}
