// Legacy

function renderHeaders(headers) {
    var headersArray = Object.values(headers).map(header => {
        return '<th class="text-xs">'+header+'</th>';
    }).join('');

    return '<tr>'+headersArray+'</tr>';
}

function LatestOrders(data) {
    return `<tr>
                <td class="text-info text-xs">
                    <a class="text-ellipsis inline" href="${data.customers_link}" target="_blank" data-toggle="tooltip" data-placement="right" title="${data.customers_name}">${data.customers_name}</a>
                </td>
                <td class="text-xs">${data.date_created}</td>
                <td class="text-xs">${data.amount}</td>
                <td>
                    <span class="label ${data.order_status_color}">${data.status_id}</span>
                </td>
                <td class="text-info">
                    <a href="${data.order_link}" title="${data.defines.TEXT_BLOCK_OVERVIEW_ACTION_EDIT}">
                        <i class="fa fa-edit"></i>
                    </a>
                </td>
            </tr>` 
}

function MostViewed(data) {
    return `<tr>
                <td class="text-xs">${data.id}</td>
                <td><img src="${data.image}" alt="${data.name}" title="${data.name}"></td>
                <td class="text-xs">${data.name}</td>
                <td class="text-xs">${data.views}</td>
                <td class="text-info text-xs"><a href="${data.defines.DIR_WS_CATALOG}product_info.php?products_id=${data.id}" target="_blank">${data.defines.TEXT_BLOCK_OVERVIEW_ACTION_VIEW}</a></td>
            </tr>`;
}

function MostSold(data) {
    return `<tr>
                <td class="text-xs">${data.id}</td>
                <td><img src="../getimage/50x50/products/yooga2(1).jpg" alt="${data.name}" title="${data.name}"></td>
                <td class="text-xs">${data.name}</td>
                <td class="text-xs">${data.orders}</td>
                <td class="text-info text-xs"><a href="${data.defines.DIR_WS_CATALOG}product_info.php?products_id=${data.id}" target="_blank">${data.defines.TEXT_BLOCK_OVERVIEW_ACTION_VIEW}</a></td>
            </tr>`;           
}

function TopCategories(data) {
    return `<tr>
                <td class="text-xs">${data.id}</td>
                <td class="text-xs">${data.name}</td>
                <td class="text-xs">${data.orders}</td>
                <!--<td class="text-info text-xs"><a href="${data.defines.DIR_WS_CATALOG}product_info.php?products_id=${data.id}" target="_blank">${data.defines.TEXT_BLOCK_OVERVIEW_ACTION_VIEW}</a></td>-->
                <td class="text-info text-xs">
                    <a href="${data.defines.DIR_WS_CATALOG}index.php?cPath=${data.id}" target="_blank">${data.defines.TEXT_BLOCK_OVERVIEW_ACTION_VIEW}</a>
                </td>
            </tr>`;           
}

function MostSearches(data) {
    return `<tr>
                <td class="text-xs">${data.text}</td>
                <td class="text-xs">${data.count}</td>
            </tr>`;           
}
