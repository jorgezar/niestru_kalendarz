

$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div> <input type="text" name="usluga[' + x + ']" placeholder="Nazwa..."/> <input type="text" name="czas[' + x + ']" placeholder="Czas w min."/> <input type="color" name="color[' + x + ']"/> <a href="#" class="remove_field"> Kasuj</a> </div>'); // add input boxes.
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
})