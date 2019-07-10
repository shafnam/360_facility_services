$(function () {
    //$('.pnm, .price, .subtot, .grdtot').prop('readonly', true);
    var $tblrows = $("#orderTable tbody tr");

    $tblrows.each(function (index) {
        var $tblrow = $(this);
        // alert($tblrow);

        $tblrow.find('.calc').on('keyup change', function () {
            
            var qty = $tblrow.find(".qty").val();
            var price = $tblrow.find(".unit_price").val();
            var subTotal = 0;

            //alert(qty);

            // check if either qty or unit_price doesnt have a value
            if ( (qty.length == 0) || (price.length == 0)){
                // set subTotal to null
                subTotal = null;
            } else {
                subTotal = parseInt(qty, 10) * parseFloat(price);
                $tblrow.find(".description").prop('required',true); // make description mandatory
            }
            
            // var price = $tblrow.find("[name=unit_price]").val();

            if (!isNaN(subTotal) && subTotal > 0) {

                $tblrow.find('.sub_total').val(subTotal.toFixed(2));

                var grandTotal = 0;
                var total = 0;
                var tax = 0;

                $(".sub_total").each(function () {
                    var stval = parseFloat($(this).val());
                    grandTotal += isNaN(stval) ? 0 : stval;
                });

                $('.grand_total').val(grandTotal.toFixed(2));

                tax = ( parseFloat(grandTotal) * 10 ) / 100 ;

                $('.tax').val(tax.toFixed(2));

                total = parseFloat(grandTotal) + parseFloat(tax);

                $('.total').val(total.toFixed(2));
            }
            else {
                // reset all to empty
                $tblrow.find('.sub_total').val('');
                $('.grand_total').val('');
                $('.tax').val('');
                $('.total').val('');
            }
        });
    });
});

$(function ($) {
    $("#upload_file").change(function(){
        $('#image_preview').html("");
        var total_file=document.getElementById("upload_file").files.length;
        for(var i=0;i<total_file;i++)
        {
            $('#image_preview').append("<img src='"+URL.createObjectURL(event.target.files[i])+"'>");
        }
    });
});

$(function ($) {
    $("#changes-save-button").hide();

    $("#changes-button").click(function(){
        $(".qty").prop('readonly',false);
        $(".unit_price").prop('readonly',false);
        $("#changes-button").hide();
        $("#changes-save-button").show();
    });
    
});