<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkbox Event with SweetAlert</title>

  <!-- Include SweetAlert2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">

</head>
<body>

  <h2>Checkbox Event with SweetAlert</h2>

  <input type="checkbox" id="myCheckbox"> Check me

  <!-- Include SweetAlert2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script>
    var checkbox = document.getElementById('myCheckbox');

    checkbox.addEventListener('change', function() {
      if (checkbox.checked) {
        // Display SweetAlert confirmation when the checkbox is checked
        Swal.fire({
          title: 'Checkbox Checked',
          text: 'Do you want to perform this action?',
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes',
          cancelButtonText: 'No'
        }).then((result) => {
          if (result.value) {
            // User clicked 'Yes', update the checkbox value
            checkbox.checked = true;
            Swal.fire('Task performed!', '', 'success');
          } else {
            // User clicked 'No', uncheck the checkbox
            checkbox.checked = false;
            Swal.fire('Task canceled', '', 'info');
          }
        });
      } else {
        // Display SweetAlert confirmation when the checkbox is unchecked
        Swal.fire({
          title: 'Checkbox Unchecked',
          text: 'Do you want to perform this action?',
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes',
          cancelButtonText: 'No'
        }).then((result) => {
          if (result.value) {
            // User clicked 'Yes', update the checkbox value
            checkbox.checked = false;
            Swal.fire('Task performed!', '', 'success');
          } else {
            // User clicked 'No', leave the checkbox unchecked
            checkbox.checked = true;
            Swal.fire('Task canceled', '', 'info');
          }
        });
      }
    });
  </script>

</body>
</html>
