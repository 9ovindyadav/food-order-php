
    function getMenu(){
        const menuObj = $.map($("input[name='menu[]']:checked"), function (element) {
            const menuString = $(element).val();
            const parts = menuString.split('/');

            const name = parts[0].trim();
            const price = parseFloat(parts[1].trim());
            const id = parseInt(parts[2].trim());

            const menuObject = { name: name, price: price, id: id };
            return menuObject;
        });

        return menuObj ;
    }

    $("input[name='dinning-table']").on("change", function () {
        updateOrderPreview();
    });

    $("input[name='menu[]']").on("change", function () {
        updateOrderPreview();
    });

    function updateOrderPreview() {
    
        const table = $.map($("input[name='dinning-table[]']:checked"), function (element) {
            return $(element).val();
        });

        const menuObj = getMenu();

        let totalAmount = 0;
        const tableBody = $('#orderTableBody');

        tableBody.empty();
        let srno = 1 ;
        menuObj.forEach(function (item) {
            var row = '<tr><td>' + srno + '</td><td>' + item.name + '</td><td>' + item.price + '</td></tr>';
            tableBody.append(row);
            srno++ ;

            totalAmount += item.price;
        });

        $('#totalAmount').html('&#x20B9;'+totalAmount.toFixed(2));
    }
    
    var baseColor = "rgb(230,230,230)";
    var activeColor = "rgb(237, 40, 70)";

    var child = 1;
    var sections = $("section");
    var length = sections.length - 1;
    $("#prev").addClass("disabled");
    $('#submit').addClass("disabled");

    sections.not(":first").hide().css('transform', 'translateX(100px)');

    $(".button").click(function () {

        var id = $(this).attr("id");
        if (id === "next") {
            $("#prev").removeClass("disabled");

            if (child >= length) {
                $(this).addClass("disabled");
                $('#submit').removeClass("disabled");
            }
            if (child <= length) {
                child++;
            }
        } else if (id === "prev") {
            $("#next").removeClass("disabled");
            $('#submit').addClass("disabled");
            if (child <= 2) {
                $(this).addClass("disabled");
            }
            if (child > 1) {
                child--;
            }
        }

        var currentSection = $("section:nth-of-type(" + child + ")");
        currentSection.fadeIn().css('transform', 'translateX(0)');
        currentSection.prevAll('section').css('transform', 'translateX(-100px)');
        currentSection.nextAll('section').css('transform', 'translateX(100px)');
        sections.not(currentSection).hide();
    });


    $('#order-form').submit(function (e) {
        e.preventDefault();
        const userId = $("input[name='user_id']").val();

        const data = {
            user_id: userId,
            menu : getMenu()
        };
        
        $.ajax({
          type: 'POST',
          url: '/order/create',
          data: data,
        })
          .done((data) => {
            alert(data);
            window.location.href = '/counter/home'
            })
          .fail((err) => {
            alert(err);
            location.reload();
          })
      });


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
                alert(response)
                location.reload();
            },
            error: function (error) {
                alert(error)
                location.reload();
            }
        });
    });


    $('.payment_status').on('change', function () {
        const selectedStatus = $(this).val();
        const orderId = $(this).closest('.payment_status_form').data('order-id');
    
        // console.log(selectedStatus, orderId);
    
        $.ajax({
            type: 'POST',
            url: '/payment/update/status',
            data: {
                order_id: orderId,
                payment_status: selectedStatus
            },
            success: function (response) {
                alert(response)
                location.reload();
            },
            error: function (error) {
                alert(error)
                location.reload();
            }
        });
    });
    

   

