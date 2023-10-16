document.addEventListener('DOMContentLoaded', async function () {
    try {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', '/element/fyp', true);
    
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    document.getElementById('fyp').innerHTML = xhr.responseText;
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
