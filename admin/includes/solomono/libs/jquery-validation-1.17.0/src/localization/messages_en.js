$.extend( $.validator.messages, {
    required: "This field is required.",
    remote: "Please enter a valid value.",
    email: "Please enter a valid email address.",
    url: "Please enter a valid URL.",
    date: "Please enter a valid date.",
    dateISO: "Please enter a valid date in ISO format.",
    number: "Please enter a number.",
    digits: "Please enter only numbers.",
    creditcard: "Please enter a valid credit card number.",
    equalTo: "Please enter the same value again.",
    extension: "Please select a file with the correct extension.",
    maxlength: $.validator.format( "Please enter no more than {0} characters." ),
    minlength: $.validator.format( "Please enter at least {0} characters." ),
    rangelength: $.validator.format( "Please enter a length between {0} and {1} characters." ),
    range: $.validator.format( "Please enter a number from {0} to {1}." ),
    max: $.validator.format( "Please enter a number less than or equal to {0}." ),
    min: $.validator.format( "Please enter a number greater than or equal to {0}." )
} );
