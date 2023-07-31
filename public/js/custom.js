$(document).ready(function () {
    $(".wishlist-icon").on('click', function () {
        var product_id = $(this).data('product-id');
        var is_added = $(this).data('is-added');

        var _token = $('meta[name="csrf-token"]').attr('content');
        var base_url = $('meta[name="base-url"]').attr('content');
        var currentThis = $(this);

        $.ajax({
            url: base_url + '/wishList/' + product_id + '/update',
            method: 'POST',
            data: {_token: _token, is_added: is_added},
            dataType: 'json',
            success: function (response) {
                console.log(response);
                if (response.success === true) {
                    $(".cart-total").html(response.total);
                    currentThis.attr('data-is-added', response.is_added).data('is-added', response.is_added);
                    if (response.is_added === 0) {
                        currentThis.find('i').removeClass('fa fa-heart').addClass('fa fa-heart-o');
                    } else if (response.is_added === 1) {
                        currentThis.find('i').removeClass('fa fa-heart-o').addClass('fa fa-heart');
                    }
                }
            },
            error: function (err) {
                console.log(err);
            }
        });

    });
});

function showLoginDialog() {
    var base_url = $('meta[name="base-url"]').attr('content');
    swal({
        text: "Login required! Click ok to login!",
        icon: "warning",
        buttons: true
    })
        .then((willDelete) => {
            if (willDelete) {
                window.location.href = base_url+'/login';
            } else {
            }
        });
}
