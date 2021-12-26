$(document).ready(function () {
  $(".edit_btn").click(function () {
    $edit_id=$(this).attr("data-id");
    $.ajax({
      url: 'ajax_edit.php',
      type: 'GET',
      data: {
        'id': $edit_id,
      },
      success: function(response){
        console.log(response);
        const obj = JSON.parse(response);
        // console.log(obj.article_title);
        console.log(typeof(response));
        $('#title').val(obj.article_title);
        $('#hid_id').val($edit_id);
        $('#content').val(obj.article_content);
      }
    });
    $("#modal_frm").modal();
  });

  $(".update_btn").click(function () {
    hid_id=$('#hid_id').val();
    title=$('#title').val();
    content=$('#content').val();
    $.ajax({
      url: 'ajax_edit.php',
      type: 'POST',
      data: {
        'id': hid_id,
        'title': title,
        'content': content,
      },
      success: function(response){
        // const obj = JSON.parse(response);
        // console.log(obj.article_title);
        // console.log(typeof(response));
        // $('#title').val(obj.article_title);
        // $('#content').val(obj.article_content);
        console.log("updated");
      }
    });
    $("#modal_frm").modal();
  });

  $(".view_btn").click(function () {
    $view_id=$(this).attr("data-id");
    // console.log($view_id);
    $.ajax({
      url: 'ajax_edit.php',
      type: 'GET',
      data: {
        'id': $view_id,
      },
      success: function(response){
        // console.log(response);
        const obj = JSON.parse(response);
        // console.log(obj);
        console.log(obj);
        html='<td >'+obj.article_title+'</td>';
        html+='<td >'+obj.article_content+'</td>';
        $('.view_data').empty();
        $('.view_data').append(html);
      }
    });
    $("#view_modal").modal();
  });
});
