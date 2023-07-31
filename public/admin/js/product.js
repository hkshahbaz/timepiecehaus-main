document.addEventListener('DOMContentLoaded', function () {
    $(".filterSearch").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $(this).closest('.outer-list-div').find('.filterList > div > label').filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    /*$("#productTypeSearch").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#productTypeList div label").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });*/
});
