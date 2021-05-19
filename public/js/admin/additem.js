let buttonAdd = document.getElementById('button_add');

buttonAdd.onclick = function addItem() {
    let name = document.getElementById('name').value;
    let cost = document.getElementById('cost').value;
    let count = document.getElementById('count').value;
    //let tag = document.getElementById('teg').value;
    let cat = document.getElementById('cat').value;
    let cinfo = document.getElementById('cinfo').value;
    let info = document.getElementById('info').value;
    let inputFiles = document.getElementById('file');

    // if (tag === '')
    // {
    //     tag = 'none';
    // }
    const formData = new FormData();

    formData.append('name', name);
    formData.append('cost', cost);
    formData.append('count', count);
    formData.append('tag', 'none');
    formData.append('cat', cat);
    formData.append('cinfo', cinfo);
    formData.append('name', name);
    formData.append('info', info);

    for (let i = 0; i < inputFiles.files.length; i++)
    {
        let file = inputFiles.files[i];
        formData.append('file[]', file);
    }

    if (!checkForms(inputFiles.files.length))
    {
        return false;
    }

    fetch('/admin/main/addItem', {
        method: 'post',
        body: formData
    }).catch(function(err) {
        console.log(err);
    });

    function checkForms(imagesCount)
    {
        let inputs = document.querySelectorAll('.Check');
        let errorImages = document.getElementById('checkImages');
        let check = true;
        inputs.forEach(item => {
            if (item.value === '')
            {
                item.previousElementSibling.children[0].innerHTML = ' Необходимо заполнить форму';
                check = false;
            }
            else
            {
                item.previousElementSibling.children[0].innerHTML = '';
            }
        });

        if (imagesCount > 4)
        {
            errorImages.innerHTML = ' Количество картинок не должно превышать 4';
            return false;
        }
        else
        {
            imagesCount.innerHTML = ' ';
        }
        return check;
    }
};