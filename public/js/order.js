$(document).ready(function () {
    
    $(document).ready(function () {
        $("input[name='dinning-table']").on("change", function () {
            updateOrderPreview();
        });

        $("input[name='menu']").on("change", function () {
            updateOrderPreview();
        });

        function updateOrderPreview() {
        
            const table = $.map($("input[name='dinning-table']:checked"), function (element) {
                return $(element).val();
            });

            const tableItems = $.map($("input[name='menu']:checked"), function (element) {
                return $(element).val();
            });

            const ordered = $.map(tableItems,function (item) {
                return `<h1><li>${item}</li></h1>`
            });

            const orderPreviewContent = table.concat(tableItems).join(', ');
            $("#order-prev-table").html(table.join(" ").toUpperCase());
            $("#order-prev-menuItems").html(ordered.join(" "));
        }
    });


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

});

   

