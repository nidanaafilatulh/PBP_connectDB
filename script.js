$(document).ready(function() {
  // Handle form submission using AJAX
  $("#filterForm").submit(function(e) {
      e.preventDefault(); // Prevent the default form submission
      
      var formData = $(this).serialize(); // Serialize the form data
      
      $.ajax({
          url: $(this).attr("action"), // Use the form's action attribute as the URL
          type: "POST",
          data: formData, // Send the form data
          success: function(data) {
              // Replace the content of the "container" with the updated results
              $("#container").html(data);
          }
      });
  });
});
