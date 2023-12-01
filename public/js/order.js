
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

        menuObj.forEach(function (item) {
            var row = '<tr><td>' + item.name + '</td><td>' + item.price + '</td></tr>';
            tableBody.append(row);

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

        const table = $.map($("input[name='dinning-table[]']:checked"), function (element) {
            return $(element).val();
        });

        const data = {
            table : table,
            menu : getMenu()
        };
      
        $.ajax({
          type: 'POST',
          url: '/order/create',
          data: data,
        })
          .done((data) => {
            $(this).trigger('reset');
            alert(data);

            if (confirm('Do you want to place a new order?')) {
                
                location.reload(); 
            }
            })
          .fail((err) => {
            
            alert(err);
          })
          .always(() => {
            console.log('always called');
          });
      });
    

   

