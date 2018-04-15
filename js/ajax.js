//Getting value from "ajax.php".
function fill(Value1, Value2) {   
    //Assigning value to "inlineFormInputGroup" div in "inlineFormInputGroup.php" file.
    $('#inlineFormInputGroup').val(Value1); 
    $('#CustID').val(Value2);  
    //Hiding "display" div in "inlineFormInputGroup.php" file.
    $('#display').hide();
}

function fillProducts(Value1, Value2) {   
    //Assigning value to "inlineFormInputGroup" div in "inlineFormInputGroup.php" file.
    $('#productInput').val(Value1);   
    $('#ProdID').val(Value2);   
    //Hiding "display" div in "inlineFormInputGroup.php" file.
    $('#product').hide();
}
$(document).ready(function() {   
    //On pressing a key on "productinput box" in "Report_Customeritems.php" file. This function will be called.
    $("#productInput").keyup(function() {
        //alert(1);
        //Assigning inlineFormInputGroup box value to javascript variable named as "name".
        var name = $('#productInput').val();       
        //Validating, if "name" is empty.       
        if (name == "") {           
            //Assigning empty value to "display" div in "inlineFormInputGroup.php" file.
            $("#product").html("");       
        }       
        //If name is not empty.
        else {           
            //AJAX is called.
            $.ajax({               
                //AJAX type is "Post".
                type: "POST",
                               
                //Data will be sent to "ajax.php".
                url: "Products_Ajax.php",
                               
                //Data, that will be sent to "ajax.php".
                data: {                   
                    //Assigning value of "name" into "inlineFormInputGroup" variable.
                    //search: name
                    item: name               
                },
                               
                //If result found, this funtion will be called.
                success: function(html) {                   
                    //Assigning result to "display" div in "inlineFormInputGroup.php" file.
                    $("#product").html(html).show();               
                }           
            });       
        }
    });   
    $("#inlineFormInputGroup").keyup(function() {
        //alert(1);
        //Assigning inlineFormInputGroup box value to javascript variable named as "name".
               
        var name = $('#inlineFormInputGroup').val();       
        //Validating, if "name" is empty.
               
        if (name == "") {           
            //Assigning empty value to "display" div in "inlineFormInputGroup.php" file.
            $("#display").html("");       
        }       
        //If name is not empty.
        else {           
            //AJAX is called.
            $.ajax({               
                //AJAX type is "Post".
                type: "POST",
                               
                //Data will be sent to "ajax.php".
                url: "Customers_Ajax.php",
                               
                //Data, that will be sent to "ajax.php".
                data: {                   
                    //Assigning value of "name" into "inlineFormInputGroup" variable.
                    //search: name
                    inlineFormInputGroup: name               
                },
                               
                //If result found, this funtion will be called.
                success: function(html) {                   
                    //Assigning result to "display" div in "inlineFormInputGroup.php" file.
                    $("#display").html(html).show();               
                }           
            });       
        }   
    });
    $('.openTicket').on('click', function() {
        var dataURL = $(this).attr('data-href');
        $('.modal-title').text('INVOICE# ' + $(this).attr('data-title'))
        $('.modal-body').load(dataURL, function() {
            $('#modal-id').modal({ show: true });
        });
    });
});