document.addEventListener("click", function(event) {
    if (event.target.matches("#dialog-cancel-button")) {
      closeDialog()
    }

    if (event.target.matches("#dialog-music-submit-button")) {
      submitMusicForm();
    }

    if (event.target.matches("#dialog-music-delete-button")) {
      deleteMusicForm();
    }

    if (event.target.matches(".add-music")) {
      openAddMusicDialog();
    }

    if (event.target.matches(".edit-music")) {
      openEditMusicDialog(event);
    }
});


document.addEventListener("change", function(event) {
  if (event.target.matches("#album-option")) {
    pushImage();
  }


});

document.addEventListener("change", function(event) {
  if (event.target.matches("#input-album-image-url")) {
    pushImage(event);  
  }

  if (event.target.matches("#input-music-audio-url")) {
    pushLabel(event);  
  }
});

function pushLabel(event) {
  var label = document.getElementById("file-input-label");
  label.innerHTML = event.target.value;
}


function openAddMusicDialog() {
  const xhr = new XMLHttpRequest();
  const method = "GET";
  const url = "/element/music-input";
  xhr.open(method, url);
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      document.querySelector(".dialog-section").innerHTML = xhr.responseText;
    }
  };
  xhr.send();
}

function openEditMusicDialog(event) {
  const xhr = new XMLHttpRequest();
  const method = "GET";
  const id = event.target.getAttribute("value");
  const url = "/element/music-input/" + id;
  xhr.open(method, url);
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      document.querySelector(".dialog-section").innerHTML = xhr.responseText;
    }
  };
  xhr.send();
}


function deleteMusicForm() {
  let xhr = new XMLHttpRequest();
  let method = "DELETE";
  const id = document.getElementById("dialog-music").getAttribute('id-music');
  let url = `/api/musics/${id}`;
  xhr.open(method, url, true); 
  xhr.onreadystatechange = function () {
    alert(JSON.parse(xhr.responseText).message);
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

function submitMusicForm() {

  const musicTitle = document.getElementById("music-title").value;
  const idAlbum = document.getElementById("album-option").value;
  const audio = document.getElementById("input-music-audio-url").files[0];
  const idGenre = document.getElementById("genre-option").value;
  if (!validateInputs([musicTitle, idAlbum, audio, idGenre])) {
    alert("Field cannot be empty!");
    return;
  }

  let formData = new FormData();
  formData.append("title", musicTitle);
  formData.append("id_album", idAlbum)
  formData.append("audio", audio); 
  formData.append("id_genre", idGenre);

  let method = "POST";
  const id = document.getElementById("dialog-music").getAttribute('id-music');
  let url;
  if (id) {
    url = `/api/musics/${id}`
  } else {
    url = `/api/musics`
  }
  let xhr = new XMLHttpRequest();

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

function pushImage() {
  const image_url = (event.target.options[event.target.selectedIndex].getAttribute("image_url"));
  document.getElementById("album-image-preview").src = image_url;
}

function validateInputs(inputsArray) {
  for (let i = 0; i < inputsArray.length; i++) {
      if (!inputsArray[i] || inputsArray[i] === "") {
          return false; 
      }
  }
  return true;
}




// function loadAlbumOption() {
//     let xhr =  new XMLHttpRequest();
//     let method = "GET";
//     let url = "/api/albums";
//     xhr.open(method, url, true);
//     xhr.onreadystatechange = function () {
//     if (xhr.readyState === 4 && xhr.status === 200) {
//         // console.log(JSON.stringify(xhr.response));
//       let select = document.getElementById("album-option");
//       let responseData = JSON.parse(xhr.responseText);
//       let albums = responseData.data
//       select.innerHTML = "";
//       albums.forEach(function(album) {
//         let option = document.createElement("option");
//         option.value = album.id_album;
//         option.text = album.title;   
//         option.setAttribute("image_url", album.image_url);
//         select.appendChild(option); 
//       });
//     } else {
//       console.error("Request failed with status:", xhr.status);
//     }
//     };
//     xhr.send();
//   }
//   document.getElementById("album-option").addEventListener("change", function(event) {
//     const image_url = (this.options[this.selectedIndex].getAttribute("image_url"));
//     console.log("FOOBAR");
//     document.getElementById("album-image-preview").src = image_url;
//   });

//   function loadGenreOption() {
//     let xhr =  new XMLHttpRequest();
//     let method = "GET";
//     let url = "/api/genres";
//     xhr.open(method, url, true);
//     xhr.onreadystatechange = function () {
//     if (xhr.readyState === 4 && xhr.status === 200) {
//       let select = document.getElementById("genre-option");
//       let responseData = JSON.parse(xhr.responseText);
//       let genres = responseData.data
//       select.innerHTML = "";
//       genres.forEach(function(genre) {
//         let option = document.createElement("option");
//         option.value = genre.id_genre;
//         option.text = genre.name;   
//         select.appendChild(option); 
//       });
//     } else {
//       console.error("Request failed with status:", xhr.status);
//     }
//     };
//     xhr.send();
//   }



// addEventListener("DOMContentLoaded", (event) => {
//   loadAlbumOption();
//   loadGenreOption();
// });
