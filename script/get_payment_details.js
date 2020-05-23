async function ajaxGetPaymentDetails()
{
    let url = "php/get_payment_details.php";
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
        document.getElementById("user_name").value = jsonData[0].name;
        document.getElementById("user_email").value = jsonData[0].email;
        document.getElementById("order_amount").value = jsonData[0].order_total;
        document.getElementById("cart_quantity").value = jsonData[0].quantity;
    }
}


