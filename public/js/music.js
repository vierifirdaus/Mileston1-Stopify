document.addEventListener('DOMContentLoaded', async function () {
    try {
        const xhr = new XMLHttpRequest();
        var currentUrl = window.location.href;
        var url = new URL(currentUrl);
        var idValue = url.searchParams.get("id");
        console.log('awalll',idValue);
        xhr.open('GET', '/element/music/'+idValue, true);

    
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    const data =xhr.responseText;
                    document.getElementById("page-wrapper").innerHTML = data
                } else {
                    console.error('HTTP error! Status: ', xhr.status);
                }
            }
        };
    
        xhr.send();
    } catch (error) {
        console.error('Error fetching data:', error.message);
    }

});

function handleLoveButtonClick() {
    // Implement the logic for handling the love button click here
    // alert('like button clicked!');
    try {
        const xhr = new XMLHttpRequest();
        var currentUrl = window.location.href;

        var url = new URL(currentUrl);
        var idValue = url.searchParams.get("id");

        var idUser=document.getElementById("id_user").value;

        console.log(document.getElementById('likeButton').innerHTML)

        likeStatus=document.getElementById('likeButton').innerHTML == "Like ❤️"

        xhr.open(likeStatus ? 'POST' : 'DELETE', '/api/users/'+idUser+'/likes/'+idValue, true);
        console.log('/api/users/'+idUser+'/likes/'+idValue)
        
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    document.getElementById('likeButton').innerHTML = likeStatus ? "Unlike ❤️" : "Like ❤️";
                } else {
                    console.error('HTTP error! Status: ', xhr.status);
                }
            }
        };

    
        xhr.send();
    } catch (error) {
        console.error('Error fetching data:', error.message);
    }
}
