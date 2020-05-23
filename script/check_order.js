function displayRadioValue()
{
    var ele = document.getElementsByName('shipping');

    for (i = 0; i < ele.length; i++) {
        if (ele[i].checked)
            return ele[i].value;
    }
}


async function ajaxCheckOrder()
{
    let client_total = parseFloat(total_order) + parseFloat(displayRadioValue());

    let url = "php/check_order_total.php";    /* use POST method to send data to ajax_json_search.php */
    let jsonParameters = {shipping: displayRadioValue(), total: client_total};
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

    function updateWebpage(jsonData)
    {
        if (jsonData[0].correct === '1')
        {
            window.location.href = "make_payment.php";
        }
    }
}


