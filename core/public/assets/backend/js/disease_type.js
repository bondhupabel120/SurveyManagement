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

function diseasetypesubmit(){
    // $('.alert').setTimeout(function() {
    // }, 1000);

    $("#frmCheckout").validate({
        rules: {
            disease_type_name: {
                required: true,
                minlength: 3
            },
        },
        onfocusout: function(element) {
            this.element(element); // triggers validation
        },
        onkeyup: function(element, event) {
            this.element(element); // triggers validation
        },
        messages: {
            disease_type_name: {
                required: "Enter Disease Type Name",
                minlength: "Disease Type Name requires at least 3 characters"
            },

        },
        submitHandler: function (form) {
            var data = $("#frmCheckout").serialize();
            $.ajax({
                url: 'save_disease_type',
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
                    output += '<td>' + response[i].disease_type_name + '</td>';
                    if(response[i].status == 1){
                        output += '<td> <span class="badge badge-success">' + "Active"+ '</td>';
                    }
                    else{
                        output += '<td> <span class="badge badge-danger">' + "Deactive"+ '</td>';
                    }
                    
                    output += '<td>' + '<a style="padding:2px" name="'+response[i].id+'" onclick="editdiseasetype(this.name)" class="btn btn-primary btn-xs"> <i class="fa fa-folder-open"></i> Edit </a> <a class="btn btn-danger btn-xs" id="'+response[i].id+'" onclick="deleteDiseaseType(this.id,event)" style="padding:2px; color:#fff"> <i class="fas fa-remove"></i> Delete </a> ' + '</td>';
                    output += '</tr>';
                }
                $("#disease_type_data").empty();
                $("#disease_type_data").html(output);
                }
            })
        }
    });
}
function editdiseasetype(id)
{
    $.ajax({
        url: 'edit_disease_type',
        method: 'get',
        data: {id:id},
        dataType: 'json',
        success:function (data) {
            if(data){
                $("#disease_type_name").val(data.disease_type_name);
                $("#disease_type_id").val(data.id);
                $("#disease_type_name").focus();
            }
        }
    })
}



