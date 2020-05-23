function getURL()
{
    let idUrl = window.location; // http://google.com?id=test
    let query_string = idUrl.search;
    let search_params = new URLSearchParams(query_string);
    let product_id = search_params.get('id');
    let intId = parseInt(product_id);
    return intId;
}

async function ajaxAddToCart()
{
    let url = "php/add_item_cart.php";    /* use POST method to send data to ajax_json_search.php */
    let jsonParameters = {product_id: getURL(), quantity: document.getElementById('quantity_input').value};
    console.log(JSON.stringify(jsonParameters));
    try
    {
        const response = await fetch(url,
                {
                    method: "POST",
                    headers: {'Accept': 'application/json', 'Content-Type': 'application/json'},
                    body: JSON.stringify(jsonParameters)
                });

        updateWebpage();
    } catch (error)
    {
        console.log("Fetch failed: ", error);
    }

    /* use the fetched data to change the content of the webpage */
    function updateWebpage()
    {
        snackBox();
    }

    //https://www.w3schools.com/howto/howto_js_snackbar.asp
    function snackBox() {
        // Get the snackbar DIV
        let x = document.getElementById("snackbar");

        // Add the "show" class to DIV
        x.className = "show";

        // After 3 seconds, remove the show class from DIV
        setTimeout(function () {
            x.className = x.className.replace("show", "");
        }, 3000);
    }

}


