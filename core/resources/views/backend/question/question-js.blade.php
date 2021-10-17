<script>
    // Question Type
    function formcheck(data) {
        if (data == "1") {
            $('#optionCheck').css("display", "none");
        } else if (data == "2") {
            $('#optionCheck').css("display", "block");
        } else if (data == "3") {
            $('#optionCheck').css("display", "block");
        } else if (data == "4") {
            $('#optionCheck').css("display", "block");
        } else {
            $('#optionCheck').css("display", "none");
        }
    }
    /* Option Field Expand */
    $(document).ready(function() {
        console.log('ok');
        var max_fields = 50;
        var wrapper = $(".appendField");
        var add_button = $(".addNewField");

        var x = 1;
        $(add_button).click(function(e) {
            e.preventDefault();
            if (x < max_fields) {
                x++;
                $(wrapper).append(
                    '<div class="row mb-2"><div class="col-md-11"><input type="text" name="option[]" class="form-control" autofocus></div><a href="#" class="delete"><span class="fa fa-trash text-danger"></span></a></div>'
                    );
            } else {
                alert('You Reached the limits')
            }
        });

        $(wrapper).on("click", ".delete", function(e) {
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });

    /* Remove Previous Field */
    $(document).ready(function() {
        var wrapper = $(".appendFieldEdit");
        var x = '$optionCount';

        $(wrapper).on("click", ".deletePrevField", function(e) {
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });
</script>
