document.addEventListener("DOMContentLoaded", initial);

// document.getElementById("limit").addEventListener("change", changeLimit);

// document.getElementById("right").addEventListener("click", nextPage);

// document.getElementById("left").addEventListener("click",prevPage);

document.addEventListener("click", function(event) {
    if (event.target.matches("#left")) {
        prevPage();
    }

    if (event.target.matches("#right")) {
        nextPage();
    }

})

document.addEventListener("change", function(event) {
    if (event.target.matches("#limit")) {
        changeLimit();
    }

})


function initial(){
    
    var currentUrl = window.location.href;
    var url = new URL(currentUrl);
    var limitValue = url.searchParams.get("limit");
    var pageValue = url.searchParams.get("page");

    
    if(limitValue==null){
        limitValue = 5;
    }
    
    if(pageValue==null){
        pageValue = 1;
    }
    
    console.log("limit ",limitValue)
    console.log("page " ,pageValue)

    fillData(limitValue,pageValue);
}

function changeLimit() {
    var currentUrl = window.location.href;
    var url = new URL(currentUrl);
    var limit = url.searchParams.get("limit");
    if(limit==null){
        limit=document.getElementById("limit").value;
    }
    var limit = document.getElementById("limit").value;

    history.pushState(null, null, "?limit=" + limit+"&page"+1+"&id="+url.searchParams.get("id"));
    document.getElementById("current-page").innerHTML = 1;

    console.log("id",document.getElementById("limit").value)
    document.getElementById("limit").innerHTML = limit;
    fillData(limit,1);
}


async function fillData(limit,page) {
    // const id_album = document.getElementById("id_album").value;
    // const url = 'element/music_pagination/'+id_album+'/'+page+'/'+limit;
    // console.log(url);
    try {
        const xhr = new XMLHttpRequest();
        
        var currentUrl = window.location.href;
        var urlnew = new URL(currentUrl);

        var id_album = urlnew.searchParams.get("id");

        const url = 'element/music_pagination/'+id_album+'/'+page+'/'+limit;
        console.log(url);
        xhr.open('GET', url, true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    const data = xhr.responseText;
                    console.log(data)
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
}


function nextPage() {
    var currentUrl = window.location.href;
    var url = new URL(currentUrl);

    var limit = url.searchParams.get("limit");
    var pageValue = url.searchParams.get("page");
    if(limit==null){
        limit=document.getElementById("limit").value;
    }
    if(pageValue==null){
        pageValue = 1;
    }
    var page = pageValue + 1;

    console.log(page);
    console.log(document.getElementById("max-page").innerHTML);
    if(page > parseInt(document.getElementById("max-page").innerHTML)) page = parseInt(document.getElementById("max-page").innerHTML);

    fillData(limit, page);

    document.getElementById("current-page").innerHTML = page;

    history.pushState(null, null, "?limit=" + limit + "&page=" + page+"&id="+url.searchParams.get("id"));
}

function prevPage() {
    var currentUrl = window.location.href;
    var url = new URL(currentUrl);

    var limit = url.searchParams.get("limit");
    var pageValue = url.searchParams.get("page");
    if(limit==null){
        limit=document.getElementById("limit").value;
    }
    if(pageValue==null){
        pageValue = 1;
    }
    var page = pageValue - 1;

    if(page < 1) page = 1;

    fillData(limit, page);

    document.getElementById("current-page").innerHTML = page;

    history.pushState(null, null, "?limit=" + limit + "&page=" + page+"&id="+url.searchParams.get("id"));
}
