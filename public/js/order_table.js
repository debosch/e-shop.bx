const requestURL = '/admin/main/orders';

// status - статус получаемых заказов
function getOrders(status = null)
{
    return new Promise((resolve, reject) =>
    {
        const xhr = new XMLHttpRequest();

        xhr.open('POST', requestURL, true);
        xhr.responseType = 'json';
        xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');

        xhr.open('POST', requestURL);
        xhr.onload = () =>
        {
           if (xhr.status >= 400)
           {
               reject(xhr.response);
           }
           else
           {
               resolve(xhr.response);
           }
        }

        xhr.send(JSON.stringify(status));
    })
}

function fillTable(data)
{
    let table_holder = document.getElementById('table_holder');
    data = Object.values(data);
    let rowsCount = data.length;
    let template = document.querySelector('#order_table_template');
    let clone = template.content.cloneNode(true);
    let tbody = clone.getElementById('order_table_body');

    for (let i = 0; i < rowsCount - 1; i++)
    {
        let row = document.createElement("tr");
        let rowData = Object.values(data[i]);

        for (let j = 0; j < rowData.length; j++)
        {
            let cell = document.createElement("td");
            let cellText = document.createTextNode(rowData[j].toString());

            cell.appendChild(cellText);
            row.appendChild(cell);
        }

        if (i === rowsCount - 2)
        {
            tbody.appendChild(row);
            rowData = Object.values(data[i + 1]);
            row = document.createElement("tr");
            for (let j = 0; j < rowData.length; j++)
            {
                let cell = document.createElement("td");
                let cellText = document.createTextNode(rowData[j].toString());
                cell.appendChild(cellText);
                row.appendChild(cell);
            }

            if (data[i]['ORDER_ID'] !== data[i + 1]['ORDER_ID'])
            {
                table_holder.appendChild(clone);

                clone = template.content.cloneNode(true);
                tbody = clone.getElementById('order_table_body');

                tbody.appendChild(row);
                tbody.appendChild(createButtonRow());
                table_holder.appendChild(clone);
                break;
            }
            else if (data[i]['ORDER_ID'] === data[i + 1]['ORDER_ID'])
            {
                tbody.appendChild(row);
                tbody.appendChild(createButtonRow());
                table_holder.appendChild(clone);
                break;
            }
        }

        if (data[i]['ORDER_ID'] !== data[i + 1]['ORDER_ID'])
        {
            tbody.appendChild(row);

            tbody.appendChild(createButtonRow());
            table_holder.appendChild(clone);

            clone = template.content.cloneNode(true);
            tbody.id = data[i]['ORDER_ID'];
            tbody = clone.getElementById('order_table_body');
            continue;
        }

        tbody.appendChild(row);
    }
}

function createButtonRow()
{
    let button = document.createElement("button");
    button.setAttribute("type", "submit");
    button.innerHTML = 'Обработать';

    button.addEventListener('click', function()
    {
        button.disabled = true;
        // Изменение статуса
    })

    let buttonRow = document.createElement("tr");
    let buttonCol = document.createElement('td');
    buttonCol.setAttribute('colspan', '8');
    buttonCol.appendChild(button);
    buttonRow.appendChild(buttonCol);

    return buttonRow;
}

getOrders()
    .then(data => fillTable(data))
    .catch(err => console.log(err));
