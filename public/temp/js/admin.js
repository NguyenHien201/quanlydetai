// tạo Alias tự động
$(document).ready(function () {
    $('#title-store').on('input', function () {
        var title = $(this).val();
        var slug = slugify(title);
        $('#slug-store').val(slug);
    });
    $('.form-edit').each(function () {
        var title = $(this).find('.form-control.title')
        var slug = $(this).find('.form-control.slug')
        title.on('input',function () {
            var title_val = $(this).val();
            var slug_val = slugify(title_val);
            slug.val(slug_val); // Sửa chỗ này
        });
    });

    function slugify(text) {
        var unaccentedText = text
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '');
        return unaccentedText
            .toLowerCase()
            .trim()
            .replace(/\s+/g, '-')
            .replace(/[^\w\-]+/g, '')
            .replace(/\-\-+/g, '-')
            .replace(/^-+|-+$/g, '');
    }
});