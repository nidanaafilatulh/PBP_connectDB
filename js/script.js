$(document).ready(function() {
  // Handle form submission using AJAX
  $("#filterForm").submit(function(e) {
      e.preventDefault(); 
      
      var formData = $(this).serialize(); 
      
      $.ajax({
          url: $(this).attr("action"), 
          type: "POST",
          data: formData, 
          success: function(data) {
              $("#container").html(data);
          }
      });
  });
});
