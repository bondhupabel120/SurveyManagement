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

function vaccinesubmit(){
    // $('.alert').setTimeout(function() {
    // }, 1000);

    $("#frmCheckout").validate({
        rules: {
            vaccine_name: {
                required: true,
                minlength: 3
            },
            dose: {
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
            vaccine_name: {
                required: "Enter Vaccine Name",
                minlength: "Vaccine Name requires at least 3 characters"
            },

        },
        submitHandler: function (form) {
            var data = $("#frmCheckout").serialize();
            $.ajax({
                url: 'save_vaccine',
                method: "post",
                data: data,
                dataType: "json",
                success:function (response) {
                    $('#frmCheckout')[0].reset();
                    var length = response.length;
                var output = "";
                var i;
                for(i=0; i<length; i++) {
                    output += '<tr>';
                    output += '<td>' + i + '</td>';
                    output += '<td>' + response[i].vaccine_name + '</td>';
                    output += '<td>' + response[i].dose + '</td>';
                    if(response[i].status == 1){
                        output += '<td> <span class="badge badge-success">' + "Active"+ '</td>';
                    }
                    else{
                        output += '<td> <span class="badge badge-danger">' + "Deactive"+ '</td>';
                    }
                    output += '<td>' + '<a style="padding:2px" name="'+response[i].id+'" onclick="editvaccine(this.name)" class="btn btn-primary btn-xs"> <i class="fa fa-folder-open"></i> Edit </a> <a class="btn btn-danger btn-xs" id="'+response[i].id+'" onclick="deleteVaccine(this.id,event)" style="padding:2px; color:#fff"> <i class="fas fa-remove"></i> Delete </a> ' + '</td>';
                    output += '</tr>';
                }
                $("#vaccine_data").empty();
                $("#vaccine_data").html(output);
                }
            })
        }
    });
}
function editvaccine(id)
{
    $.ajax({
        url: 'edit_vaccine',
        method: 'get',
        data: {id:id},
        dataType: 'json',
        success:function (data) {
            if(data){
                $("#vaccine_name").val(data.vaccine_name);
                $("#dose").val(data.dose);
                $("#vaccine_id").val(data.id);
                $("#status").val(data.status).attr("selected",true);
                $("#vaccine_name").focus();
            }
        }
    })
}



