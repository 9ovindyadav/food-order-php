$('#admin_add_menu').submit(function (e) {
    e.preventDefault();

    const data = {
      menu_name: $(this).find('[name=menu_name]').val(),
      price: $(this).find('[name=price]').val(),
      img: $(this).find('[name=img]').val(),
    };
    console.log(data)
    $.ajax({
      type: 'POST',
      url: '/menu/create',
      data: data,
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


  $('.admin_update_menu').submit(function (e) {
    e.preventDefault();
    const form = $(this);
    
    const data = {
        menu_id: form.find('[name=menu_id]').val(),
      menu_name: form.find('[name=menu_name]').val(),
      price: form.find('[name=menu_price]').val(),
      menu_status: form.find('[name=menu_status]').val(),
      img: form.find('[name=menu_img]').val(),
    };
    console.log(data)

      $.ajax({
        type: 'POST',
        url: '/menu/update',
        data: data,
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

  
  $('.admin_delete_menu').submit(function (e) {
    e.preventDefault();
    const form = $(this);

    const data = {
      menu_id: form.find('[name=menu_id]').val()
    };
  
    $.ajax({
      type: 'POST',
      url: '/menu/delete',
      data: data,
      success: function (response) {
        alert(response)
        location.reload();
      },
      error: function (error) {
        alert(error);
        location.reload();
      }
    });
  });


  $('.menu_status').on('change', function () {
    const selectedStatus = $(this).val();
    const menuId = $(this).closest('.menu_status_form').data('menu-id');

    console.log(selectedStatus, menuId);

    $.ajax({
        type: 'POST',
        url: '/menu/update/status',
        data: {
            menu_id: menuId,
            menu_status: selectedStatus
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