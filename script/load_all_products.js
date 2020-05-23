function getURL()
{
    var idUrl = window.location; // http://google.com?id=test
    var query_string = idUrl.search;
    var search_params = new URLSearchParams(query_string);
    var page_number = search_params.get('page_number');
    var int_page_number = parseInt(page_number);
    return int_page_number;
}


async function ajaxPagination(user_state)
{
    let url = "php/pagination_links.php";
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
        document.getElementById('product_grid').innerHTML = "";
        let page_link;
        page_link = '<ul>';
        for (let i = 0; i < jsonData[0].num_of_links; i++)
        {
            page_link += '<li><a href="categories.php?page_number=' + (i + 1) + '">0' + (i + 1) + '.</a></li>';
        }
        page_link += '</ul>';
        console.log(page_link);
        document.querySelector('div.product_pagination').innerHTML = page_link;
        ajaxAllProducts(getURL(), user_state);
        ajaxGetDistinctCategories();

    }
}

async function ajaxAllProducts(page_number, user_state)
{
    let url = "php/get_all_products.php";
    let urlParameters = {page_number: page_number};
    console.log(JSON.stringify(urlParameters));
    try
    {
        const response = await fetch(url,
                {
                    method: "POST",
                    headers: {'Content-type': 'application/x-www-form-urlencoded; charset=UTF-8'},
                    body: JSON.stringify(urlParameters)
                });

        updateWebpage(await response.json());
    } catch (error)
    {
        console.log("Fetch failed: ", error);
    }

    function updateWebpage(jsonData)
    {
        if (user_state === 1)
        {
            let htmlString;
            for (let i = 0; i < jsonData.length; i++)
            {
                htmlString = '<div class="product">';
                htmlString += '<div class="product_image"><img src="' + jsonData[i].product_image + '" alt=""></div>';
                htmlString += '<div class="product_extra"><a href="categories.html"></a></div>';
                htmlString += '<div class="product_content">';
                htmlString += '<div class="product_title"><a href="product.php?id=' + jsonData[i].product_id + '">' + jsonData[i].product_name + '</a></div>';
                htmlString += '<div class="product_price">€' + jsonData[i].price + '</div>';
                htmlString += "<a href='php/delete_product.php?product_id=" + jsonData[i].product_id + "'>Delete</a>";
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

}

async function ajaxGetDistinctCategories()
{
    let url = "php/get_all_categories.php";
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
        let sorting_list = '<ul class="item_sorting"><li>';
        sorting_list += '<span class="sorting_text">Sort by</span>';
        sorting_list += '<i class="fa fa-chevron-down" aria-hidden="true"></i><ul>';
        sorting_list += '<li class="product_sorting_btn"><span onclick="ajaxPagination()">All</span></li>';
        for (let i = 0; i < jsonData.length; i++)
        {
            sorting_list += '<li class="product_sorting_btn"><span><option onclick=ajaxListCategory(this.value) value="' + jsonData[i].category + '">' + jsonData[i].category + '</option></span></li>';
        }
        sorting_list += '</ul></li></ul>';
        document.getElementById('sorting').innerHTML = sorting_list;
    }
}







