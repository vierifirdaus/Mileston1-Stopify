
document.addEventListener("click", function(event) {
  if (event.target.matches("#dialog-cancel-button")) {
    closeDialog();
  }

  if (event.target.matches("#dialog-genre-submit-button")) {
    submitGenreForm();
  }

  if (event.target.matches("#dialog-genre-delete-button")) {
    deleteGenreForm();
  }

  if (event.target.matches(".add-genre")) {
      openAddGenreForm();
  }

  if (event.target.matches(".edit-genre")) {
    openEditGenreForm(event);
  }
});

function openEditGenreForm(event) {
  const xhr = new XMLHttpRequest();
  const method = "GET";
  const id = event.target.parentElement.getAttribute("value");
  const url = "/element/genre-input/" + id;
  xhr.open(method, url);
  xhr.onreadystatechange = function () {
    document.querySelector(".dialog-section").innerHTML = xhr.responseText;
  };
  xhr.send();
}


function openAddGenreForm() {
  const xhr = new XMLHttpRequest();
  const method = "GET";
  const url = "/element/genre-input";
  xhr.open(method, url);
  xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          const response = xhr.responseText;
          document.querySelector(".dialog-section").innerHTML = xhr.responseText;
      } else {
          console.error("Request failed with response:", xhr.responseText);
        }
      }
    };
  xhr.send();
}

function deleteGenreForm() {
  let xhr = new XMLHttpRequest();
  let method = "DELETE";
  const id = document.getElementById("dialog-genre").getAttribute('id-genre');
  let url = `/api/genres/${id}`;
  xhr.open(method, url, true);
  xhr.onreadystatechange = function () {
    alert(JSON.parse(xhr.responseText).message)
  };
  
  let conf_msg = `Are you sure you want to proceed delete?`;
  if (confirm(conf_msg)) {
    xhr.send();
    closeDialog();
  } 
}

function closeDialog() {
  const dialog = document.getElementsByClassName("dialog-wrapper")[0];
  if (dialog) {
    dialog.remove();
  }
}

document.addEventListener('change', function (event) {
  if (event.target.matches('#input-genre-image-url')) {
    var output = document.getElementById('genre-image-preview');
    var fileUrl = URL.createObjectURL(event.target.files[0]);
    output.src = fileUrl;
    output.onload = function() {
    URL.revokeObjectURL(output.src) 
    }

    var label = document.getElementById("file-input-label");
    label.innerHTML = event.target.value;
  }

  if (event.target.matches("#genre-name")) {
      var output = document.getElementById('genre-name-preview');
      output.innerHTML = event.target.value;
  }

  if (event.target.matches("#genre-color")) {
      var output = document.getElementById('genre-card-preview');
      output.style.backgroundColor = event.target.value;
  }
});

function submitGenreForm() {
  let genreName = document.getElementById("genre-name").value;
  let image = document.getElementById("input-genre-image-url").files[0];
  let color = document.getElementById("genre-color").value;

  if (!validateInputs([genreName, image, color])) {
    alert("Field cannot be empty!");
    return;
  }

  let formData = new FormData();
  formData.append("name", genreName);
  formData.append("image", image);
  formData.append("color", color);

  let xhr = new XMLHttpRequest();
  let method = "POST";
  const id = document.getElementById("dialog-genre").getAttribute('id-genre');
  let url;
  if (id) {
   url = `/api/genres/${id}`;
  } else {
    url = `/api/genres`;
  }
  xhr.open(method, url, true);
  xhr.onreadystatechange = function () {
    console.log(JSON.stringify(xhr.response));
  };
  let conf_msg = `Are you sure you want to proceed ${(id ? "update" : "add")}?`;
  if (confirm(conf_msg)) {
    alert(JSON.parse(xhr.responseText).message)
    closeDialog();
  } 
}

function validateInputs(inputsArray) {
  for (let i = 0; i < inputsArray.length; i++) {
      if (!inputsArray[i] || inputsArray[i] === "") {
          return false; 
      }
  }
  return true;
}