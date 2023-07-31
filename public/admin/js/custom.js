$(document).ready(function () {
    var _token = $('meta[name="csrf-token"]').attr('content');
    $('table').on('click', '.delete-row', function () {
        var table_id = $(this).closest('table').attr('id');
        var id = $(this).data('row-id');
        var url = $("#delete-route-path").val();

        var notice = new PNotify({
            title: '<strong>Confirm Delete</strong>',
            text: 'Are you sure you want to delete?',
            width: '320px',
            hide: false,
            confirm: {
                confirm: true,
                buttons: [
                    {
                        text: 'Yes',
                        addClass: 'btn btn-sm btn-primary'
                    },
                    {
                        addClass: 'btn btn-sm btn-link'
                    }
                ]
            },
            buttons: {
                closer: false,
                sticker: false
            },
            history: {
                history: false
            }
        });

        notice.get().on('pnotify.confirm', function () {
            $.ajax({
                url: url + '/' + id,
                method: 'DELETE',
                data: {_token: _token},
                success: function (response) {
                    if (response.success === true) {
                        $("#" + table_id).dataTable().fnDraw();
                        new PNotify({
                            title: 'Success',
                            layout: 'center',
                            text: response.message,
                            icon: 'icon-checkmark3',
                            type: 'success'
                        });
                    } else {
                        new PNotify({
                            title: 'Error',
                            layout: 'center',
                            text: response.message,
                            icon: 'icon-blocked',
                            type: 'error'
                        });
                    }
                },
                error: function (err) {
                    new PNotify({
                        title: 'Error',
                        layout: 'center',
                        text: 'Something went wrong!',
                        icon: 'icon-blocked',
                        type: 'error'
                    });
                    console.log(err);
                }
            });
        });
    });

    $('table').on('click', '.restore-row', function () {
        var table_id = $(this).closest('table').attr('id');
        var id = $(this).data('row-id');
        var url = $("#restore-route-path").val();

        var notice = new PNotify({
            title: '<strong>Confirm Restore</strong>',
            text: 'Are you sure you want to restore?',
            width: '320px',
            hide: false,
            confirm: {
                confirm: true,
                buttons: [
                    {
                        text: 'Yes',
                        addClass: 'btn btn-sm btn-primary'
                    },
                    {
                        addClass: 'btn btn-sm btn-link'
                    }
                ]
            },
            buttons: {
                closer: false,
                sticker: false
            },
            history: {
                history: false
            }
        });

        notice.get().on('pnotify.confirm', function () {
            $.ajax({
                url: url + '/' + id,
                method: 'POST',
                data: {_token: _token},
                success: function (response) {
                    if (response.success === true) {
                        $("#" + table_id).dataTable().fnDraw();
                        new PNotify({
                            title: 'Success',
                            layout: 'center',
                            text: response.message,
                            icon: 'icon-checkmark3',
                            type: 'success'
                        });
                    } else {
                        new PNotify({
                            title: 'Error',
                            layout: 'center',
                            text: response.message,
                            icon: 'icon-blocked',
                            type: 'error'
                        });
                    }
                },
                error: function (err) {
                    new PNotify({
                        title: 'Error',
                        layout: 'center',
                        text: 'Something went wrong!',
                        icon: 'icon-blocked',
                        type: 'error'
                    });
                    console.log(err);
                }
            });
        });
    });

    $('table').on('click', '.permanent-delete-row', function () {
        var table_id = $(this).closest('table').attr('id');
        var id = $(this).data('row-id');
        var url = $("#permanent-delete-route-path").val();

        var notice = new PNotify({
            title: '<strong>Confirm Permanent Delete</strong>',
            text: 'Are you sure you want to delete permanently?',
            width: '320px',
            hide: false,
            confirm: {
                confirm: true,
                buttons: [
                    {
                        text: 'Yes',
                        addClass: 'btn btn-sm btn-primary'
                    },
                    {
                        addClass: 'btn btn-sm btn-link'
                    }
                ]
            },
            buttons: {
                closer: false,
                sticker: false
            },
            history: {
                history: false
            }
        });

        notice.get().on('pnotify.confirm', function () {
            $.ajax({
                url: url + '/' + id,
                method: 'DELETE',
                data: {_token: _token},
                success: function (response) {
                    if (response.success === true) {
                        $("#" + table_id).dataTable().fnDraw();
                        new PNotify({
                            title: 'Success',
                            layout: 'center',
                            text: response.message,
                            icon: 'icon-checkmark3',
                            type: 'success'
                        });
                    } else {
                        new PNotify({
                            title: 'Error',
                            layout: 'center',
                            text: response.message,
                            icon: 'icon-blocked',
                            type: 'error'
                        });
                    }
                },
                error: function (err) {
                    new PNotify({
                        title: 'Error',
                        layout: 'center',
                        text: 'Something went wrong!',
                        icon: 'icon-blocked',
                        type: 'error'
                    });
                    console.log(err);
                }
            });
        });
    });
});

// update product status
function updateProductStatus(product_id, status_id){
    console.log(product_id, status_id);
    if(product_id !== '' && status_id !== '' && product_id !== undefined && status_id !== undefined){
        var notice = new PNotify({
            title: '<strong>Confirm Status Update</strong>',
            text: 'Are you sure you want to update status?',
            width: '320px',
            hide: false,
            confirm: {
                confirm: true,
                buttons: [
                    {
                        text: 'Yes',
                        addClass: 'btn btn-sm btn-primary'
                    },
                    {
                        addClass: 'btn btn-sm btn-link'
                    }
                ]
            },
            buttons: {
                closer: false,
                sticker: false
            },
            history: {
                history: false
            }
        });
        notice.get().on('pnotify.confirm', function () {
            let url = 'products/update/status/'+ product_id;
            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: url,
                method: 'POST',
                data: {_token: _token, status_id: status_id},
                success: function (response) {
                    if (response.success === true) {
                        new PNotify({
                            title: 'Success',
                            layout: 'center',
                            text: response.message,
                            icon: 'icon-checkmark3',
                            type: 'success'
                        });
                        $(".product"+product_id).empty().html(response.status);
                    } else {
                        new PNotify({
                            title: 'Error',
                            layout: 'center',
                            text: response.message,
                            icon: 'icon-blocked',
                            type: 'error'
                        });
                    }
                },
                error: function (err) {
                    new PNotify({
                        title: 'Error',
                        layout: 'center',
                        text: 'Something went wrong!',
                        icon: 'icon-blocked',
                        type: 'error'
                    });
                    console.log(err);
                }
            });
        });

    }
}
