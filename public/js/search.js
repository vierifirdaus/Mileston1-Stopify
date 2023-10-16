document.addEventListener("change", function(event) {
    if (event.target.matches("#search-by") ||
        event.target.matches("#year-filter") ||
        event.target.matches("#genre-filter") ||
        event.target.matches("#sort-by") ||
        event.target.matches("#order-by")) {
            executeSearch()
    }
});

document.addEventListener("DOMContentLoaded", function() {
    callSearch();
});

document.addEventListener("keyup", function(event) {
    if (event.target.matches(".search-bar")) {

        executeSearch()
    }
});

function debounce(func, timeout = 300) {
    let timer;
    return (...args) => {
      clearTimeout(timer);
      timer = setTimeout(() => { func.apply(this, args); }, timeout);
    };
}

function callSearch() {
    const searchQuery = document.querySelector(".search-bar").value;
    const searchBy = document.querySelector("#search-by").value;
    const yearFilter = document.querySelector("#year-filter").value;
    const genreFilter = document.querySelector("#genre-filter").value;
    const sortBy = document.querySelector("#sort-by").value;
    const orderBy = document.querySelector("#order-by").value;

    

    const method = "GET";
    const url = "/element/search-table/"
    const queryParams = {
        "sub_str": searchQuery,
        "sub_str_param": searchBy,
        "year": yearFilter, 
        "genre": genreFilter,
        "sort_by": sortBy + " " + orderBy,
        "current_page": 1,
        "limit": 10
    };
    const queryString = Object.keys(queryParams)
        .map(key => `${encodeURIComponent(key)}=${encodeURIComponent(queryParams[key])}`)
        .join('&');
    const urlWithParams = `${url}?${queryString}`;
    const xhr = new XMLHttpRequest();
    xhr.open("GET", urlWithParams, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            const response = xhr.responseText;
            document.querySelector(".search-result").innerHTML = response;
          } else {
            console.error("Request failed with response:", xhr.responseText);
          }
        }
      };
    xhr.send();
}


document.addEventListener("click", function(event) {
  if (event.target.matches("#left")) {
      prevPage();
  }

  if (event.target.matches("#right")) {
      nextPage();
  }

})


function nextPage() {
  var limit = 10;
  var currentPageElement = document.getElementById("current-page");
  var page = parseInt(currentPageElement.innerHTML) + 1;

  console.log('max ',document.getElementById("max-page").innerHTML);
  if(page > parseInt(document.getElementById("max-page").innerHTML)) {
    page = parseInt(document.getElementById("max-page").innerHTML);
    return;
  }
  fillData(limit, page);
  currentPageElement.innerHTML = page;
  console.log('next',page);


  // history.pushState(null, null, "?limit=" + limit + "&page=" + page);

}

function prevPage() {
  var limit = 10;
  var currentPageElement = document.getElementById("current-page");
  var page = parseInt(currentPageElement.innerHTML) - 1;

  if(page < 1){
    page=1;
    return;
    
  }
  currentPageElement.innerHTML = page;

  fillData(limit, page);


  // history.pushState(null, null, "?limit=" + limit + "&page=" + page);
}

async function fillData(limit,page) {
  try {
    const searchQuery = document.querySelector(".search-bar").value;
    const searchBy = document.querySelector("#search-by").value;
    const yearFilter = document.querySelector("#year-filter").value;
    const genreFilter = document.querySelector("#genre-filter").value;
    const sortBy = document.querySelector("#sort-by").value;

    const method = "GET";
    const url = "/element/search-table/"
    const queryParams = {
        "sub_str": searchQuery,
        "sub_str_param": searchBy,
        "year": yearFilter, 
        "genre": genreFilter,
        "sort_by": sortBy,
        "current_page": page,
        "limit": limit
    };
    console.log("current ",queryParams.current_page)
    const queryString = Object.keys(queryParams)
        .map(key => `${encodeURIComponent(key)}=${encodeURIComponent(queryParams[key])}`)
        .join('&');
    const urlWithParams = `${url}?${queryString}`;
    const xhr = new XMLHttpRequest();
    xhr.open("GET", urlWithParams, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            const response = xhr.responseText;
            document.querySelector(".search-result").innerHTML = response;
            document.getElementById("current-page").innerHTML = queryParams.current_page;
          } else {
            console.error("Request failed with response:", xhr.responseText);
          }
        }
      };
    xhr.send();
  } catch (error) {
      console.error('Error fetching data:', error.message);
  }
}

const executeSearch = debounce(() => callSearch());