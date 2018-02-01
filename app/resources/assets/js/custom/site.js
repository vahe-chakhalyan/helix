$(document).ready(function() {
  $(".delete-article").click(function() {
    var _this = $(this);
    var article_id = _this.attr("data-article-id");
    if (confirm("Are you sure you want to delete this article?") == true) {
      $("#article_delete_form").attr("action", "/articles/" + article_id);
      $("#article_delete_form").submit();
    }
  });
  $(function() {
    $("#datetimepicker").datetimepicker({ format: "YYYY-MM-DD HH:mm:ss" });
  });

  // for image preview
  $(function(){
    $('.upload-file').change(function(){
      var input = this;
      var url = $(this).val();
      var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
      if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg"))
      {
        var reader = new FileReader();

        reader.onload = function (e) {
          $('#imgPreview').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
      }
      else
      {
        $('#imgPreview').attr('src', '/assets/no_preview.png');
      }
    });

  });
});
