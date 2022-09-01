$(document).ready(function (e) {
    $(document).on('change', '.star', function () {
        $(this).parents('.post-stars').submit();
    });
});
