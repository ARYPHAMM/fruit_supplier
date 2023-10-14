var showMessOk = (msg, status, noti = false) => {
    Swal.fire(!noti ? "Thông báo" : noti, msg, status);
};
async function likeJob(id, event) {
    // event.classList.contains("like--active")

    await axios
        .post("like-job", { id: id })
        .then((res) => {
            if (res.data.data == "like") {
                event.classList.add("like--active");
                event.querySelector(".like--job").innerText =
                    parseInt(event.querySelector(".like--job").innerText || 0) +
                    1;
            } else {
                event.classList.remove("like--active");
                event.querySelector(".like--job").innerText =
                    parseInt(event.querySelector(".like--job").innerText) - 1;
            }
        })
        .catch((error) => {
            showMessOk(error.response.data.msg, "warning");
        });
}

var loadFile = function (event, field_id, is_file = false) {
    if (!is_file) {
        var reader = new FileReader();
        reader.onload = function () {
            var output = document.getElementById(field_id);
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    } else {
        const url = URL.createObjectURL(event.target.files[0]);
        var output = document.getElementById(field_id);
        output.href = url;
        output.innerText = event.target.files[0].name;
    }
};
var emptyFileUpload = function (file_id, preview_id) {
    var el = document.getElementById(file_id);
    el.value=null;
    var output = document.getElementById(preview_id);
        output.href = '';
        output.innerText = '';
  
};
var removeImage = (msg = false, title = false) => {
    return new Promise((resolve, reject) => {
        Swal.fire({
            title: !title ? "Thông báo" : title,
            text: !msg ? "Bạn chắc chắn xóa?" : msg,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Đồng ý",
            cancelButtonText: "Hủy",
        }).then((result) => {
            if (result.isConfirmed) resolve(true);
            else reject(false);
        });
    });
};
// $(document).ready(function () {
//     var invalidChars = ["-", "e", "+", "E"]; // replace ký tự trong type number
//     $("input[type='number'].type-number").on("keydown", function (e) {
//         if (invalidChars.includes(e.key)) {
//             e.preventDefault();
//         }
//     });
//     $("[data-group='gallery']").fancybox();
// });
// $(document).on(
//     "click.bs.dropdown.data-api",
//     '[data-toggle="collapse"]',
//     function (e) {
//         e.stopPropagation();
//     }
// );
// var removeItem = (path, msg = false,title = false) => {
//     Swal.fire({
//         title: !title? "Thông báo"  : title,
//         text: !msg ? "Bạn chắc chắn xóa?" : msg,
//         icon: "warning",
//         showCancelButton: true,
//         confirmButtonColor: "#3085d6",
//         cancelButtonColor: "#d33",
//         confirmButtonText: "Đồng ý",
//         cancelButtonText: "Hủy",
//     }).then((result) => {
//         if (result.isConfirmed) {
//             window.location.href = path;
//         }
//     });
// };
// var removeItemPost = async (path, id, msg = false) => {
//     Swal.fire({
//         title: "Thông báo",
//         text: !msg ? "Bạn chắc chắn xóa?" : msg,
//         icon: "warning",
//         showCancelButton: true,
//         confirmButtonColor: "#3085d6",
//         cancelButtonColor: "#d33",
//         confirmButtonText: "Đồng ý",
//         cancelButtonText: "Hủy",
//     }).then(async (result) => {
//         if (result.isConfirmed) {
//             await axios
//                 .post(path, { id: id })
//                 .then((res) => {
//                     showMessOk(res.data.msg, "success");
//                 })
//                 .catch((error) => {
//                     reject(error);
//                 });
//         }
//     });
// };
// var CoppyUrl = (url) =>{
//     // navigator.clipboard.writeText(url);
//     var input = document.createElement('textarea');
//     input.innerHTML = url;
//     document.body.appendChild(input);
//     input.select();
//     var result = document.execCommand('copy');
//     document.body.removeChild(input);
//     showMessOk('Coppy thành công!','success');
//     // return result;
// }
// class FileList {
//     constructor(...items) {
//         // flatten rest parameter
//         items = [].concat(...items);
//         // check if every element of array is an instance of `File`
//         if (items.length && !items.every(file => file instanceof File)) {
//         throw new TypeError("expected argument to FileList is File or array of File objects");
//         }
//         // use `ClipboardEvent("").clipboardData` for Firefox, which returns `null` at Chromium
//         // we just need the `DataTransfer` instance referenced by `.clipboardData`
//         const dt = new ClipboardEvent("").clipboardData || new DataTransfer();
//         // add `File` objects to `DataTransfer` `.items`
//         for (let file of items) {
//         dt.items.add(file)
//         }
//         return dt.files;
//     }
// };
// var changeCategoryContent = () => {
//      if($('select[name="category_id"]').val() == 1)
//         $('#price_name').html('Mức lương')
//      if($('select[name="category_id"]').val() == 2)
//         $('#price_name').html('Mức giá')
//      if($('select[name="category_id"]').val() != 2 && $('select[name="category_id"]').val() != 1)
//         $('#price_name').html('Giá');
// };

// var showMessOk = (msg, status, noti = false) => {
//     Swal.fire(!noti ? "Thông báo" : noti, msg, status);
// };
// var removeImage = (msg = false, title = false) => {
//     return new Promise((resolve, reject) => {
//         Swal.fire({
//             title: !title ? "Thông báo" : title,
//             text: !msg ? "Bạn chắc chắn xóa?" : msg,
//             icon: "warning",
//             showCancelButton: true,
//             confirmButtonColor: "#3085d6",
//             cancelButtonColor: "#d33",
//             confirmButtonText: "Đồng ý",
//             cancelButtonText: "Hủy",
//         }).then((result) => {
//             if (result.isConfirmed) resolve(true);
//             else reject(false);
//         });
//     });
// };
// var alertRemove = () => {
//     let cof = confirm("Bạn chắc chắn xóa?");
//     return cof;
// };

// var alertUpdateStatus = () => {
//     let cof = confirm("Bạn chắc chắn cập nhật trạng thái?");
//     return cof;
// };

// $(document).ready(function () {
//     $("#carousel-page").owlCarousel({
//         loop: true,
//         autoplay: true,
//         autoplayTimeout: 3000,

//         // margin: 10,
//         nav: true,
//         dots: true,
//         navText: [
//             '<i class="fa fa-angle-left" aria-hidden="true"></i>',
//             '<i class="fa fa-angle-right" aria-hidden="true"></i>',
//         ],
//         responsive: {
//             0: {
//                 items: 1,
//             },
//             600: {
//                 items: 1,
//             },
//             1000: {
//                 items: 1,
//             },
//         },
//     });
// });
