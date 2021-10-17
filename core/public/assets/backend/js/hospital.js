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

function hospitalsubmit(){
    // $('.alert').setTimeout(function() {
    // }, 1000);

    $("#frmCheckout").validate({
        rules: {
            hospital_name: {
                required: true,
                minlength: 3
            },
            license_no: {
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
            hospital_name: {
                required: "Enter Hospital Name",
                minlength: "Hospital Name requires at least 3 characters"
            },

        },
        submitHandler: function (form) {
            var data = $("#frmCheckout").serialize();
            $.ajax({
                url: 'save_hospital',
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
                    output += '<td>' + response[i].hospital_name + '</td>';
                    output += '<td>' + response[i].hospital_address + '</td>';
                    output += '<td>' + response[i].license_no + '</td>';
                    if(response[i].status == 1){
                        output += '<td> <span class="badge badge-success">' + "Active"+ '</td>';
                    }
                    else{
                        output += '<td> <span class="badge badge-danger">' + "Deactive"+ '</td>';
                    }
                    if(response[i].verify_status == 1){
                        output += '<td> <span class="badge badge-success">' + "Verified"+ '</td>';
                    }
                    else{
                        output += '<td> <span class="badge badge-danger">' + "Unauthorized"+ '</td>';
                    }
                    output += '<td>' + '<a style="padding:2px" name="'+response[i].id+'" onclick="edithospital(this.name)" class="btn btn-primary btn-xs"> <i class="fa fa-folder-open"></i> Edit </a> <a class="btn btn-danger btn-xs" id="'+response[i].id+'" onclick="deleteHospital(this.id,event)" style="padding:2px; color:#fff"> <i class="fas fa-remove"></i> Delete </a> ' + '</td>';
                    output += '</tr>';
                }
                $("#hospital_data").empty();
                $("#hospital_data").html(output);
                }
            })
        }
    });
}
function edithospital(id)
{
    $.ajax({
        url: 'edit_hospital',
        method: 'get',
        data: {id:id},
        dataType: 'json',
        success:function (data) {
            if(data){
                $("#hospital_name").val(data.hospital_name);
                $("#hospital_address").val(data.hospital_address);
                $("#license_no").val(data.license_no);
                $("#hospital_id").val(data.id);
                $("#hospital_name").focus();
            }
        }
    })
}



