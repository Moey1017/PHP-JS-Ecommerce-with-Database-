function getURL()
{
    var idUrl = window.location; // http://google.com?id=test
    var query_string = idUrl.search;
    var search_params = new URLSearchParams(query_string);
    var product_id = search_params.get('id');
    var intId = parseInt(product_id);
    return intId;
}

async function ajaxGetProduct()
{
    let url = "php/post_json_transaction.php";    /* use POST method to send data to ajax_json_search.php */
    let jsonParameters = {product_id: getURL()};
    console.log(JSON.stringify(jsonParameters));
    try
    {
        const response = await fetch(url,
                {
                    method: "POST",
                    headers: {'Accept': 'application/json', 'Content-Type': 'application/json'},
                    body: JSON.stringify(jsonParameters)
                });

        updateWebpage(await response.json());
    } catch (error)
    {
        console.log("Fetch failed: ", error);
    }
    /* use the fetched data to change the content of the webpage */
    function updateWebpage(jsonData)
    {

        let product_name = jsonData[0].product_name;
        document.querySelector('div.details_name').innerHTML = product_name;

        let product_image = '<img src="' + jsonData[0].product_image + '" alt="">';
        document.querySelector('div.details_image_large').innerHTML = product_image;

        let product_price = '<div class="details_price">€' + jsonData[0].price + '</div>';
        document.querySelector('div.price_holder').innerHTML = product_price;

        let product_avail = '<span>' + jsonData[0].availability + '</span>';
        document.querySelector('span.stock_holder').innerHTML = product_avail;

        let product_descrip = '<p>' + jsonData[0].description + '</p>';
        document.querySelector('div.details_text').innerHTML = product_descrip;

        let product_category = '<div>' + jsonData[0].category + '<span>.</span></div>';
        document.querySelector('div.title_holder').innerHTML = product_category;
    }
}


