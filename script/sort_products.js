async function ajaxListCategory(category_selected)
{
    console.log(category_selected);
    let url = "php/get_category_sort.php";   /* name of file to send request to */
    let jsonParameters = {category: category_selected}; /* Construct a url parameter string to POST to fileName */
    try
    {
        const response = await fetch(url,
                {
                    method: "POST",
                    headers: {'Content-type': 'application/x-www-form-urlencoded; charset=UTF-8'},
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
        document.querySelector('div.product_pagination').innerHTML = "";
        document.getElementById('product_grid').innerHTML = "";
        let htmlString;
        for (let i = 0; i < jsonData.length; i++)
        {
            htmlString = '<div class="product">';
            htmlString += '<div class="product_image"><img src="' + jsonData[i].product_image + '" alt=""></div>';
            htmlString += '<div class="product_extra"><a href="categories.html"></a></div>';
            htmlString += '<div class="product_content">';
            htmlString += '<div class="product_title"><a href="product.php?id=' + jsonData[i].product_id + '">' + jsonData[i].product_name + '</a></div>';
            htmlString += '<div class="product_price">€' + jsonData[i].price + '</div>';
            htmlString += '</div></div>';

            document.getElementById('product_grid').innerHTML += htmlString;
            console.log(htmlString);
        }
    }
}


