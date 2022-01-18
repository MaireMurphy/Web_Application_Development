/* function code is from https://getbootstrap.com/docs/4.0/examples/checkout/ 
This function validates the purchase form on purchase.php. The purchase form has 
class="needs-validation"
 Example starter JavaScript for disabling form submissions if there are invalid fields
*/
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
