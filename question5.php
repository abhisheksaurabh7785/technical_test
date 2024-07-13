<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bootstrap Form with Image Upload</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <!-- jQuery Validation Plugin -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
</head>
<body>
  <div class="container mt-5">
    <form id="myForm" enctype="multipart/form-data">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
      </div>
      <div class="form-group">
        <label for="mobile">Mobile Number</label>
        <input type="text" class="form-control" id="mobile" name="mobile" required>
      </div>
      <div class="form-group">
        <label for="email">Email ID</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="city">City</label>
        <input type="text" class="form-control" id="city" name="city" required>
      </div>
      <div class="form-group">
        <label for="state">State</label>
        <input type="text" class="form-control" id="state" name="state" required>
      </div>
      <div class="form-group">
        <label for="country">Country</label>
        <input type="text" class="form-control" id="country" name="country" required>
      </div>
      <div class="form-group">
        <label for="image">Image Gallery</label>
        <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>

  <script>
    $(document).ready(function() {
      // Form validation using jQuery Validate
      $('#myForm').validate({
        rules: {
          name: 'required',
          mobile: {
            required: true,
            digits: true,
            minlength: 10,
            maxlength: 10
          },
          email: {
            required: true,
            email: true
          },
          city: 'required',
          state: 'required',
          country: 'required',
          image: 'required'
        },
        messages: {
          mobile: {
            minlength: 'Enter a valid 10 digit mobile number',
            maxlength: 'Enter a valid 10 digit mobile number'
          }
        },
        submitHandler: function(form) {
          // Form submission logic
          form.submit();
        }
      });

      // Image upload without submit button using AJAX
      $('#image').change(function() {
        var formData = new FormData();
        formData.append('image', $('#image')[0].files[0]);

        $.ajax({
          url: 'upload.php', // PHP script to handle image upload
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          success: function(response) {
            // Handle successful image upload (if needed)
            console.log('Image uploaded successfully');
          },
          error: function() {
            // Handle errors (if any)
            console.log('Error uploading image');
          }
        });
      });
    });
  </script>
</body>
</html>
