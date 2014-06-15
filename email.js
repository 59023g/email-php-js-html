function resetForm($form) {
  $form.find('input:text,select, textarea').val('');
}

$(function() {
  $("#contactForm").submit(function() {

    document.ContactForm.submitf.value = 'Please wait...';

    $.post("process.php?send=comments", $("#contactForm").serialize(),
      function(data) {
        if (data.frm_check == 'error') {

          $("#message_post").hide().html("<div class='errorMessage'>" + data.msg + "</div>").fadeIn('slow');
          document.ContactForm.submitf.value = 'Submit Again';
          document.ContactForm.submitf.disabled = false;
        } else {
          $("#message_post").hide().html("<div class='successMessage'>Talk Soon!</div>").fadeIn(2000).fadeOut(4000);
          document.ContactForm.submitf.value = 'Sent. Thank you.';
          setTimeout(function() {
            $(submitf).fadeIn(500).attr('value', 'Submit');
          }, 1200);
          resetForm($('#contactForm'));
          setTimeout(function() {

            $("#contactForm").toggle("fast");
          }, 2000);
          return false;

        }
      }, "json");

    return false;

  });
});
