function deleteProductFromWishList(product_id) {
    var _token = $('meta[name="csrf-token"]').attr('content');
    var base_url = $('meta[name="base-url"]').attr('content');
    $.ajax({
        url: base_url + '/wishList/' + product_id + '/delete',
        data: {
            _token: _token
        },
        method: 'POST',
        dataType: 'json',
        success: function (response) {
            if (response.success === true) {
                $("tr#product-" + product_id).remove();
                $(".cart-total").html(response.total);
                if (response.total === 0) {
                    $("#wishListBody").append('<tr><td colspan="6" class="text-center">No Records Found!</td></tr>');
                }
            } else if (response.success === false) {
                console.log(response.message);
            } else {
                console.log('error');
            }
        },
        error: function (err) {
            console.log(err);
        }
    });
}
