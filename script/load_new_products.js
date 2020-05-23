async function ajaxNewProducts(user_state)
{
    let url = "php/get_new_products.php";
    let urlParameters = "";

    try
    {
        const response = await fetch(url,
                {
                    method: "POST",
                    headers: {'Content-type': 'application/x-www-form-urlencoded; charset=UTF-8'},
                    body: urlParameters
                });

        updateWebpage(await response.json(), user_state);
    } catch (error)
    {
        console.log("Fetch failed: ", error);
    }

    function updateWebpage(jsonData, user_state)
    {
        if (user_state === 1)
        {
            let htmlString;
            for (let i = 0; i < jsonData.length; i++)
            {
                htmlString = '<div class="product">';
                htmlString += '<div class="product_image"><img src="' + jsonData[i].product_image + '" alt=""></div>';
                htmlString += '<div class="product_extra product_new"><a href="categories.html">New</a></div>';
                htmlString += '<div class="product_content">';
                htmlString += '<div class="product_title"><a href="product.php?id=' + jsonData[i].product_id + '">' + jsonData[i].product_name + '</a></div>';
                htmlString += '<div class="product_price">€' + jsonData[i].price + '</div>';
                htmlString += "<a href='delete_product.php?product_id=" + jsonData[i].product_id + "'>Delete</a>";
                htmlString += "&nbsp&nbsp&nbsp&nbsp&nbsp";
                htmlString += "<a href='update_product.php?product_id=" + jsonData[i].product_id + "'>Update</a>";
                htmlString += '</div></div>';
                document.getElementById('product_grid').innerHTML += htmlString;
                console.log(htmlString);
            }
        } else
        {
            let htmlString;
            for (let i = 0; i < jsonData.length; i++)
            {
                htmlString = '<div class="product">';
                htmlString += '<div class="product_image"><img src="' + jsonData[i].product_image + '" alt=""></div>';
                htmlString += '<div class="product_extra product_new"><a href="categories.html">New</a></div>';
                htmlString += '<div class="product_content">';
                htmlString += '<div class="product_title"><a href="product.php?id=' + jsonData[i].product_id + '">' + jsonData[i].product_name + '</a></div>';
                htmlString += '<div class="product_price">€' + jsonData[i].price + '</div>';
                htmlString += '</div></div>';

                document.getElementById('product_grid').innerHTML += htmlString;
                console.log(htmlString);
            }
        }

    }
}


