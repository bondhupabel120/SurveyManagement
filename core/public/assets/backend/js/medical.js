$(function (){
    jQuery.validator.addMethod(
        "regex",
        function(value, element, regexp) {
            if (regexp.constructor != RegExp)
                regexp = new RegExp(regexp);
            else if (regexp.global)
                regexp.lastIndex = 0;
            return this.optional(element) || regexp.test(value);
        },
    );
})
function addMedicalDescription(){
    var person = $(".appendperson").html();
    $("#included_all_description").append(person);
}

function medicaltestsubmit(){
    $("#frmCheckout").validate({
        rules: {
            medical_test_name: {
                required: true,
                minlength: 3
            },
            description: {
                required: true
            },
            
        },
        onfocusout: function(element) {
            this.element(element); // triggers validation
        },
        onkeyup: function(element, event) {
            this.element(element); // triggers validation
        },
        messages: {
            medical_test_name: {
                required: "Enter your Medical Test Name",
                minlength: "Medical Test Name requires at least 3 characters"
            },
            description: {
                required: "Enter your Description",
            }
        },
    });
}