async function ajaxGetCartItems()
{
    let url = "php/get_cart_items.php";
    let urlParameters = "";

    try
    {
        const response = await fetch(url,
                {
                    method: "POST",
                    headers: {'Content-type': 'application/x-www-form-urlencoded; charset=UTF-8'},
                    body: urlParameters
                });

        updateWebpage(await response.json());
    } catch (error)
    {
        console.log("Fetch failed: ", error);
    }


    function updateWebpage(jsonData)
    {
        let total_price = 0;
        let cart_item;
        for (let i = 0; i < jsonData.length; i++)
        {
            cart_item = '<div class="cart_item d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start">';
            cart_item += '<div class="cart_item_product d-flex flex-row align-items-center justify-content-start">';
            cart_item += '<div class="cart_item_image">';
            cart_item += '<div><img src="' + jsonData[i].product_image + '"alt=""></div></div>';
            cart_item += '<div class="cart_item_name_container">';
            cart_item += '<div class="cart_item_name"><div><a>' + jsonData[i].product_name + '</a></div><div id="delete_cart">';
            cart_item += '<a href="php/delete_cart_item.php?product_id=' + jsonData[i].product_id + '">Remove Item</a></div></div></div></div>';
            cart_item += '<div class="cart_item_price">' + jsonData[i].price + '</div>';
            cart_item += '<div class="cart_item_quantity">';
            cart_item += '<div class="product_quantity_container">' + jsonData[i].quantity + '</div></div>';
            cart_item += '<div class="cart_item_total">' + jsonData[i].item_total + '</div></div>';
            cart_item += '<hr id="cart_seperator">';
            console.log(cart_item);
            document.getElementById('cart').innerHTML += cart_item;

            total_price = (total_price + parseFloat(jsonData[i].item_total));
        }

        total_price = total_price.toFixed(2);
        document.getElementById('subtotal').innerHTML = "€" + total_price.toString();
        getShippingPrice("Free");
    }
}
