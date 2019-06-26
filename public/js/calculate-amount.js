$(function () {
    //$('.pnm, .price, .subtot, .grdtot').prop('readonly', true);
    var $tblrows = $("#orderTable tbody tr");

    $tblrows.each(function (index) {
        var $tblrow = $(this);
        // alert($tblrow);

        $tblrow.find('.calc').on('keyup change', function () {
            
            var qty = $tblrow.find(".qty").val();
            var price = $tblrow.find(".unit_price").val();
            var subTotal = parseInt(qty, 10) * parseFloat(price);
            // var price = $tblrow.find("[name=unit_price]").val();

            if (!isNaN(subTotal)) {

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
        });
    });
});
