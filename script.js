$(document).ready(function() {
  $('#submit').click(function(e) {
    let taskItem = $('.input').val();
    $.ajax({
      type: "POST",
      url: 'loadTodo.php',
      data: {item: taskItem},
      success: function(data) {
        let dataItem = JSON.parse(data);
        let li = `<li class="items" data-id="${dataItem.id}"><p>${dataItem.task}</p>
        <a class="delete" type="submit" class="delete">Delete</a></li>`;
        $('ul').append(li);
      },
      error: function(xhr, status, error) {
        console.error(xhr, status, error);
      }
      })
    e.preventDefault();
  })

  $('.delete').each(function() {
      $(this).click(function(e) {
        let ele = $(this).parent();
        let id = ele.data('id');
        // console.log(id);
        $.ajax({
          type: "POST",
          url: 'removeTodo.php',
          data: {id: id},
          success: function(data) {
            if(data == 'success') {
              ele.remove();
            }
          },
          error: function(xhr, status, error) {
            console.error(xhr, status, error);
          }
        })
      })
  });
})
