


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
    })
      .done((data) => {
        
        $('#add-new-user').modal('hide');
        $(this).trigger('reset');
        $.ajax({
            type: 'GET',
            url: '/admin/users'
        }).done((latestData) => {

        const tempElement = $('<div>').html(latestData);
        const filteredContent = tempElement.find('body').html();
        $('body').html(filteredContent);

        })
        
      })
      .fail((err) => {
        
        $('#add-new-user').modal('hide');
        $(this).trigger('reset');
        alert(err);
      })
  });


  $('.admin_update_user').submit(function (e) {
    e.preventDefault();
    const data = {
        update_user: '',
        user_id: $(this).find('[name=user_id]').val(),
      full_name: $(this).find('[name=full_name]').val(),
      email: $(this).find('[name=email]').val(),
      role: $(this).find('[name=role]').val(),
    };
  
    $.ajax({
      type: 'POST',
      url: '/admin/users',
      data: data,
    })
      .done((data) => {
        
        $('.update_user_modal').modal('hide');
        $('.modal-backdrop').remove();
        $(this).trigger('reset');
        $.ajax({
            type: 'GET',
            url: '/admin/users'
        }).done((latestData) => {

        const tempElement = $('<div>').html(latestData);
        const filteredContent = tempElement.find('body').html();
        $('body').html(filteredContent);
        })
        
      })
      .fail((err) => {
        
        $('#add-new-user').modal('hide');
        $(this).trigger('reset');
        alert(err);
      })
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
    })
      .done((data) => {

        $(form).trigger('reset');
        $.ajax({
            type: 'GET',
            url: '/admin/users'
        }).done((latestData) => {

        const tempElement = $('<div>').html(latestData);
        const filteredContent = tempElement.find('body').html();
        $('body').html(filteredContent);
        })
        
      })
      .fail((err) => {
        console.error(err);
        alert(err);
      })
  });
