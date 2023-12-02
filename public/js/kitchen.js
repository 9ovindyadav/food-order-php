$('.order_status').on('change', function () {
    const selectedStatus = $(this).val();
    const orderId = $(this).closest('.order_status_form').data('order-id');

    // console.log(selectedStatus, orderId);

    $.ajax({
        type: 'POST',
        url: '/order/update/status',
        data: {
            order_id: orderId,
            order_status: selectedStatus
        },
        success: function (response) {
            console.log(response)
            if (alert(response)) {
                
                location.reload(); 
            }
        },
        error: function (error) {
            
            if (alert(error)) {
                
                location.reload(); 
            }
        }
    });
});