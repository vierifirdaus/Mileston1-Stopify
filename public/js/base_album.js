function redirectToAlbums() {
    var limit = document.getElementById("limit").value;
    window.location.href = '/albums?page=1&limit' + limit;
    console.log(limit);
}