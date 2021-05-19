$(function() {

	$(document).ready(function() {

		window.images = []; // UNPUT FILE NAME GLOBAL

		//INPUT FILE UPLOADER CUSTOM SCRIPT BEGIN
		$('body').on('change', '.upload__input', function(event) {

			// console.log('change');
			let messages = $(this).closest('.upload').find('.count_img, .size_img, .file_types');
			$(messages).hide();

			let files = event.target.files;
			// console.log(files.length);

			let filename = $(this).attr('name').slice(0, -2);

			let names2 = window.images[filename];
			let names = [];
			//console.log('NAMES2 !!!!! = ' + names2);
			if (names2)
			{
				names = names2;
			}

			let max_count = $(this).data('maxCount');
			// console.log('max_count' + max_count);

			for (var i = 0; i < files.length; i++)
			{

				let file = files[i];

				//count
				names.push(file.size);
				// console.log('names = ' + names);
				// console.log('FILE = ' + names.length);

				if (names.length == max_count)
				{
					$(this).closest('.upload').find('.count_img').show();
					$(this).closest('.upload').find('.count_img_var').html(max_count);
					$(this).closest('.upload').find('.upload__btn').hide();
				}
				if (names.length > max_count)
				{
					names.pop();
					return false;
				}
				window.images[filename] = names;

				//type
				var fileType = file.type;
				if (fileType == 'image/png' || fileType == 'image/jpeg' || fileType == 'video/mp4')
				{

				}
				else
				{
					$(this).closest('.upload').find('.file_types').show();
					return false;
				}

				if (fileType == 'video/mp4')
				{
					var max_size = 1;
				}
				else
				{
					var max_size = 1;
				}

				//size
				var totalBytes = file.size;

				//MB into bites
				var max_bites = max_size * 1024 * 1024;

				if (totalBytes > max_bites)
				{
					$(this).closest('.upload').find('.size_img').show();
					$(this).closest('.upload').find('.size_img_var').html(max_size + 'MB');
					return false;
				}

				var picBtn = $(this).closest('.upload').find('.upload__btn');

				var picReader = new FileReader();
				picReader.addEventListener("load", function(event) {
					var picFile = event.target;
					var picSize = event.total;
					// var picCreate = $("<div class='upload__item'>" +
					// 	"<img src='" + picFile.result + "'" + " class='upload__img' data-name='" + file.name + "' alt='" + file.name + "'> "+ "<span class='imgName'>" + file.name + "</span>"+" </img>" +
					// 	"<a data-id='" + picSize + "' class='upload__del'></a>" +
					// 	"</div>");

					var picCreate = `<div class='upload__item'>
						<div class="upload__img-content">
							<img src= ${picFile.result} class='upload__img' data-name="file.name" alt="file.name">
							<div class='imgName'> 
								<span> ${file.name} </span> <br>
								<span> ${bytesToSize(file.size)} </span> 
							</div> 
							
						</div>
						<a data-id=" ${picSize}" class='upload__del'></a>
						</div>
						`;
					$(picCreate).insertBefore(picBtn);
				});
				picReader.readAsDataURL(file);
			}
		});

		$('body').on('click', '.upload__del', function() {

			$(this).closest('.upload').find('.upload__btn').show();

			let filename = $(this).closest('.upload').find('.upload__input').attr('name').slice(0, -2);
			// console.log('FILENAME = ' + filename);

			let names = window.images[filename];

			let messages = $(this).closest('.upload').find('.count_img, .size_img, .file_types');
			$(messages).hide();

			$(this).closest('.upload__item').remove();

			var removeItem = $(this).attr('data-id');
			//var yet = names.indexOf(removeItem);
			//names.splice(yet, 1);
			//console.log(document.querySelector('.upload__input').files);
		});

	});/*$(document).ready( function()*/
});

/*$(function() { */

function bytesToSize(bytes)
{
	var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
	if (!bytes)
	{
		return '0 Byte';
	}
	var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
	return Math.round(bytes / Math.pow(1024, i)) + ' ' + sizes[i];
}