let menuicn = document.querySelector(".menuicn");
let nav = document.querySelector(".navcontainer");

menuicn.addEventListener("click", () => {
	nav.classList.toggle("navclose");
})


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
            console.log('latest data', latestData);
            $('body').html(latestData);
        })
        
      })
      .fail((err) => {
        
        $('#add-new-user').modal('hide');
        $(this).trigger('reset');
        alert(err);
      })
      .always(() => {
        console.log('always called');
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
    })
      .done((data) => {

        $(form).trigger('reset');
        $.ajax({
            type: 'GET',
            url: '/admin/users'
        }).done((latestData) => {
            console.log('latest data', latestData);
            $('body').html(latestData);
        })
        
      })
      .fail((err) => {
        console.error(err);
        alert(err);
      })
      .always(() => {
        console.log('always called');
      });
  });
