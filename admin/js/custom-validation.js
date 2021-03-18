  // For the Validation of Submitted form for User
  function validateFormSubmit(formID){
    $("#"+formID).validate( {
      rules: {
        user_name: "required",
        user_email: {
          required:true,
          email:true
        },
        user_role: "required",
      },
      messages: {
        user_name: "Username is Required.",
        user_email: {
          required:"Email Address is Required.",
          email:"Must be a valid Email Address."

        },
        user_role: "User Role is Required.",
      },
      highlight: function ( element, errorClass, validClass ) {
        $( element ).parents( ".form-group" ).addClass( errorClass );
      },
      unhighlight: function (element, errorClass, validClass) {
        $( element ).parents( ".form-group" ).removeClass( errorClass );
      },
      submitHandler: function (form) {
        // form.submit();
        return false;
      }
    });
  }