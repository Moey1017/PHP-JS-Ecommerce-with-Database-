function getURL()
{
    var idUrl = window.location; // http://google.com?id=test
    var query_string = idUrl.search;
    var search_params = new URLSearchParams(query_string);
    var product_id = search_params.get('product_id');
    var intId = parseInt(product_id);
    return intId;
}

async function ajaxGetProductToUpdate()
{
    let url = "php/post_json_transaction.php";
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
        let product_id = jsonData[0].product_id;
        document.getElementById('product_id').value = product_id;

        let product_name = jsonData[0].product_name;
        document.getElementById('name').value = product_name;

        let product_category = jsonData[0].category;
        document.getElementById('category').value = product_category;

        let product_brand = jsonData[0].brand;
        document.getElementById('brand').value = product_brand;

        let product_price = jsonData[0].price;
        document.getElementById('price').value = product_price;

        let product_description = jsonData[0].description;
        document.getElementById('description').value = product_description;

        let product_availability = jsonData[0].availability;
        document.getElementById('availability').value = product_availability;
    }
}

