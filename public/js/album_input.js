document.addEventListener("click", function(event) {
  if (event.target.matches("#dialog-album-submit-button")) {
    submitAlbumForm();
  }

  if (event.target.matches("#dialog-album-delete-button")) {
    deleteAlbumForm();
  }

  if (event.target.matches("#dialog-cancel-button")) {
    closeDialog();
  }

  if (event.target.matches(".edit-album")) {
    openEditAlbumDialog(event);
  }

  if (event.target.matches(".add-album")) {
    openAddAlbumDialog(event);
  }
});

document.addEventListener("change", function(event) {
  if (event.target.matches("#input-album-image-url")) {
    pushImage(event);  
  }
});

function pushImage(event) {
  var output = document.getElementById('album-image-preview');
  var fileUrl = URL.createObjectURL(event.target.files[0]);
  output.src = fileUrl;
  output.onload = function() {
    URL.revokeObjectURL(output.src) 
  }
  
  var label = document.getElementById("file-input-label");
  label.innerHTML = event.target.value;
}

function closeDialog() {
  const dialog = document.getElementsByClassName("dialog-wrapper")[0];
  if (dialog) {
    dialog.remove();
  }
}

function openEditAlbumDialog(event) {
  const xhr = new XMLHttpRequest;
  const method = "GET";
  const id = event.target.parentElement.getAttribute("value");
  const url = `/element/album-input/` + id; 
  xhr.open(method, url);
  xhr.onreadystatechange = function () {
    document.querySelector(".dialog-section").innerHTML = xhr.responseText;
  };
  xhr.send();
}

function openAddAlbumDialog() {
  const xhr = new XMLHttpRequest;
  const method = "GET";
  const url = `/element/album-input`; 
  xhr.open(method, url);
  xhr.onreadystatechange = function () {
    document.querySelector(".dialog-section").innerHTML = xhr.responseText;
  };
  xhr.send();
}

function submitAlbumForm() {
  let albumTitle = document.getElementById("album-title").value;
  let image = document.getElementById("input-album-image-url").files[0];
  let idArtist = document.getElementById("artist-option").value;

  if (!validateInputs([albumTitle, image, idArtist])) {
    alert("Field cannot be empty!");
    return;
  }

  let formData = new FormData();
  formData.append("title", albumTitle);
  formData.append("image", image); 
  formData.append("id_artist", idArtist);
  
  let xhr = new XMLHttpRequest();
  let method = "POST";
  const id = document.getElementById("dialog-album").getAttribute('id-album');
  let url;
  if (id) {
    url = `/api/albums/${id}`
  } else {
    url = `/api/albums`
  }
  xhr.open(method, url, true);
  
  xhr.onreadystatechange = function () {
    alert(JSON.parse(xhr.responseText).message);
  };

  let conf_msg = `Are you sure you want to proceed ${(id ? "update" : "add")}?`;
  if (confirm(conf_msg)) {
    xhr.send(formData);
    closeDialog();
  } 
}
 
function deleteAlbumForm() {
  let xhr = new XMLHttpRequest();
  let method = "DELETE";
  const id = document.getElementById("dialog-album").getAttribute('id-album');
  let url = `/api/albums/${id}`;
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

function validateInputs(inputsArray) {
  for (let i = 0; i < inputsArray.length; i++) {
      if (!inputsArray[i] || inputsArray[i] === "") {
          return false; 
      }
  }
  return true;
}









// function validateAlbum() {
//     var title = document.getElementById("title").value;
//     var id_artist = document.getElementById("id_artist").value;
//     var image_url = document.getElementById("image_url").value;
  
//     if (title === "" || id_artist === "" || image_url === "") {
//       alert("Semua bidang harus diisi.");
//         return false;
//       }
//         return true; 
//     }




// function loadArtistOption() {
//     let xhr =  new XMLHttpRequest();
//     let method = "GET";
//     let url = "/api/artists";
//     xhr.open(method, url, true);
//     xhr.onreadystatechange = function () {
//     if (xhr.readyState === 4 && xhr.status === 200) {
//       let select = document.getElementById("artist-option");
//       let responseData = JSON.parse(xhr.responseText);
//       let artists = responseData.data
//       select.innerHTML = "";
//       artists.forEach(function(artist) {
//         let option = document.createElement("option");
//         option.value = artist.id_artist;
//         option.text = artist.name;   
//         select.appendChild(option); 
//       });
//     } else {
//       console.error("Request failed with status:", xhr.status);
//     }
//     };
//     xhr.send();    
// }


//   addEventListener("DOMContentLoaded", (event) => {
//     loadArtistOption();
//   });