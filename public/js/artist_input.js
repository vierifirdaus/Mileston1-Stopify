
document.addEventListener("click", function(event) {
  if (event.target.matches("#dialog-cancel-button")) {
    closeDialog();
  }

  if (event.target.matches("#dialog-artist-submit-button")) {
    submitArtistForm();
  }

  if (event.target.matches("#dialog-artist-delete-button")) {
    deleteArtistForm();
  }

  if (event.target.matches(".edit-artist")) {
    openEditArtistDialog(event);
  }

  if (event.target.matches(".add-artist")) {
    openAddArtistDialog();
  }
});

document.addEventListener("change", function(event) {
  if (event.target.matches("#input-artist-image-url")) {
    pushImage(event);
  }
});

function pushImage(event) {
  var output = document.getElementById('artist-image-preview');
  var fileUrl = URL.createObjectURL(event.target.files[0]);
  output.src = fileUrl;
  output.onload = function() {
      URL.revokeObjectURL(output.src) 
  }
  
  var label = document.getElementById("file-input-label");
  label.innerHTML = event.target.value;   
}

function openAddArtistDialog() {
  const xhr = new XMLHttpRequest();
  const method = "GET";
  const url = "/element/artist-input";
  xhr.open(method, url);
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      document.querySelector(".dialog-section").innerHTML = xhr.responseText;
    }
  };
  xhr.send();
}



function openEditArtistDialog(event) {
  const xhr = new XMLHttpRequest();
  const method = "GET";
  const id = event.target.parentElement.getAttribute("value");
  console.log(id);
  const url = "/element/artist-input/"+id;
  xhr.open(method, url);
  xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        document.querySelector(".dialog-section").innerHTML = xhr.responseText;
      }
    };
  xhr.send();
}

function submitArtistForm() {
  let artistName = document.getElementById("artist-name").value;
  let image = document.getElementById("input-artist-image-url").files[0];

  if (!validateInputs([artistName, image])) {
    alert("Field cannot be empty!");
    return;
  }

  let formData = new FormData();  
  formData.append("artist_name", artistName);
  formData.append("image", image);

  let xhr = new XMLHttpRequest();
  let method = "POST";
  const id = document.getElementById("dialog-artist").getAttribute('id-artist');
  let url;
  if (id) {
    url = `/api/artists/${id}`
  } else {
    url = `/api/artists`
  }

  xhr.open(method, url, true);
  xhr.onreadystatechange = function () {
    alert(JSON.parse(xhr.responseText).message);
  };

  let conf_msg = `Are you sure you want to proceed ${(id ? "update" : "add")}?`;
  if (confirm(conf_msg)) {
    xhr.send(formData);
    document.getElementsByClassName("dialog-wrapper")[0].remove();
  } 
}

function deleteArtistForm() {
  let xhr = new XMLHttpRequest();
  let method = "DELETE";
  const id = document.getElementById("dialog-artist").getAttribute('id-artist');
  let url = `/api/artists/${id}`;
  xhr.open(method, url, true);
  xhr.onreadystatechange = function () {
    console.log(JSON.stringify(xhr.response));
  };


  let conf_msg = `Are you sure you want to proceed delete?`;
  if (confirm(conf_msg)) {
    xhr.send();
    document.getElementsByClassName("dialog-wrapper")[0].remove();
  } 
}

function closeDialog() {
  const dialog = document.getElementsByClassName("dialog-wrapper")[0];
  if (dialog) {
    dialog.remove();
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