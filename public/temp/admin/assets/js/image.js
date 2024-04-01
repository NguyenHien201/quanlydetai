document.addEventListener('DOMContentLoaded', function () {
    // Lắng nghe sự kiện khi input file thay đổi
    document.getElementById('upload').addEventListener('change', function (event) {
        // Kiểm tra xem người dùng đã chọn tệp hình ảnh chưa
        if (event.target.files && event.target.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                // Đặt src của thẻ img thành URL của hình ảnh mới
                document.getElementById('uploadedAvatar').setAttribute('src', e.target.result);
            }

            // Đọc tệp hình ảnh như là một URL Data
            reader.readAsDataURL(event.target.files[0]);
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    // Lưu trữ URL của ảnh ban đầu khi trang được tải
    var initialImageUrl = document.getElementById('uploadedAvatar').getAttribute('src');

    // Lắng nghe sự kiện khi người dùng bấm vào nút "Reset"
    document.querySelector('.account-image-reset').addEventListener('click', function () {
        // Đặt lại src của thẻ img thành URL của ảnh ban đầu
        document.getElementById('uploadedAvatar').setAttribute('src', initialImageUrl);

        // Xóa giá trị của input file để cho phép người dùng chọn lại tệp mới
        document.getElementById('upload').value = '';
    });
});