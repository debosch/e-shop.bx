let ordersAmount = document.getElementById('orders-amount');
let url = '/admin/main/ordersAmount';

function getOrdersAmount()
{
    return new Promise((resolve, reject) =>
    {
        const xhr = new XMLHttpRequest();

        xhr.open('GET', url);
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

        xhr.send();
    })
}

function setOrdersAmount(amount)
{
    if (amount < 1)
    {
        ordersAmount.classList.add('orders-amount--disabled');
    }
    else
    {
        ordersAmount.innerHTML = amount;
        ordersAmount.classList.remove('orders-amount--disabled');
    }
}

getOrdersAmount()
    .then(data => setOrdersAmount(data))
    .catch(err => console.log(err));
