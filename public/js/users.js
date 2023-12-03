


$('#admin_add_user').submit(function (e) {
    e.preventDefault();
    const data = {
        add_user: '',
      full_name: $(this).find('[name=full_name]').val(),
      email: $(this).find('[name=email]').val(),
      role: $(this).find('[name=role]').val(),
    };
    
    $.ajax({
      type: 'POST',
      url: '/admin/users',
      data: data,
      success: function (response) {
        alert("user added")
        location.reload();
      },
      error: function (error) {
        alert(error)
        location.reload();
      }
    });
    
  });


  $('.admin_update_user').submit(function (e) {
    e.preventDefault();
    const form = $(this);

    const data = {
        update_user: '',
        user_id: form.find('[name=user_id]').val(),
      full_name: form.find('[name=full_name]').val(),
      email: form.find('[name=email]').val(),
      role: form.find('[name=role]').val(),
    };

      $.ajax({
        type: 'POST',
        url: '/admin/users',
        data: data,
        success: function (response) {
          alert("user updated")
          location.reload();
        },
        error: function (error) {
          alert(error)
          location.reload();
        }
      });
  });

  
  $('.admin_delete_user').submit(function (e) {
    e.preventDefault();
    const form = $(this);

    const data = {
        delete_user:'',
      user_id: form.find('[name=user_id]').val()
    };
  
    $.ajax({
      type: 'POST',
      url: '/admin/users',
      data: data,
      success: function (response) {
        alert("user deleted")
        location.reload();
      },
      error: function (error) {
        alert(error);
        location.reload();
      }
    });
  });
