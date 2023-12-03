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