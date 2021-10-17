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
function savedisease() {
    $("#disease_form").validate({
        rules: {
            disease_id: {
                required: true,
            },
        },
        onfocusout: function(element) {
            this.element(element); // triggers validation
        },
        onkeyup: function(element, event) {
            this.element(element); // triggers validation
        },
        messages: {
            disease_id: {
                required: "Select Disease"
            },

        },
        submitHandler: function (form) {
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });
            var data = $("#disease_form").serialize();
            var APP_URL = $('meta[name="_base_url"]').attr('content');
            $.ajax({
                url: APP_URL + '/doctor/save_patient_disease',
                method: "post",
                data:data,
                dataType: 'json',
                success:function (response) {
                    $('#disease_form')[0].reset();
                    var length = response.length;
                    console.log(response);
                var output = "";
                var i;
                for(i=0;i<length;i++){
                    output += '<input type="checkbox" checked> <span class="title">'+response[i].disease_name+ '</span>'
                }
                console.log(output);
                $("#user_disease").css("display","flex");
                $("#user_disease_data").html("");
                $("#user_disease_data").html(output);
                
                }
            })
        }
    });
}
function saveDose(name) {
    $("#vaccine_dose_form"+name).validate({
        rules: {
            dose_no: {
                required: true,
            },
            date: {
                required: true,
            },
        },
        onfocusout: function(element) {
            this.element(element); // triggers validation
        },
        onkeyup: function(element, event) {
            this.element(element); // triggers validation
        },
        messages: {
            dose_no: {
                required: "Select Dose No"
            },
            date:{
                required: "Select Date of the given dose"
            }

        },
        submitHandler: function (form) {
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });
            var data = $("#vaccine_dose_form"+name).serialize();
            var APP_URL = $('meta[name="_base_url"]').attr('content');
            console.log(APP_URL);
            $.ajax({
                url: APP_URL + '/doctor/save_patient_dose',
                method: "post",
                data:data,
                dataType: 'json',
                success:function (response) {
                    $("#vaccine_dose_form"+name)[0].reset();
                    var length = response.length;
                    console.log(response);
                    var output = "";
                    var i;
                    var dose_length;
                    for(i=0;i<length;i++){
                        output += '<tr>';
                        output += '<td>'+response[i].dose_no+'</td>';
                        output += '<td>'+response[i].date+'</td>';
                        output += '<td>'+response[i].created_by+'</td>';
                        output += '<td>'+response[i].dose_no+'</td>';
                        output += '</tr>';
                        dose_length = response[i].dose;
                    }
                    console.log(output);
                    $("#vaccine_table"+name).html("");
                    $("#vaccine_table"+name).html(output);
                    $("#vaccine_dose_form"+name).css("display","none");
                    if(dose_length >= length){
                        $("vaccinedetailsbutton"+name).css("display","none");
                    }
                
                }
            })
        }
    });
}
function addDose(data,name)
{
    $(data).parent().children("#dose_form"+name).toggleClass("dose",1000);
}