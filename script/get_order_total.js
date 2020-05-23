function getShippingPrice(delivery_price)
{
    displayRadioValue();
    if (delivery_price === "Free")
    {
        document.getElementById('shipping_price').innerHTML = delivery_price;
        getOrderTotal(delivery_price);
    } else
    {
        document.getElementById('shipping_price').innerHTML = "€" + delivery_price;
        getOrderTotal(delivery_price);
    }

}

function getOrderTotal(delivery_price)
{

    if (delivery_price !== "Free")
    {
        document.getElementById('total').innerHTML = "";
        var order_price = parseFloat(total_order) + delivery_price;
        document.getElementById('total').innerHTML = order_price;
    } else
    {
        document.getElementById('total').innerHTML = "";
        document.getElementById('total').innerHTML = total_order;
    }
}


