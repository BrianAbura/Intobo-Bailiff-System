$(document).ready(function () {
    var rowTemplate = `
    <div class="form-row col-md-12 fees-row mt-5">
    <div class="col-md-3">
        <label>Fees Narration</label>
        <input type="text" class="form-control" name="fee_narration[]">
    </div>
    <div class="col-md-2">
        <label>Fees Amount</label>
        <input type="text" class="form-control InputAmount" name="fee_amount[]" >
    </div>
    <div class="col-md-2">
        <label>Date Added</label>
        <input type="text" class="form-control reservationdate" data-toggle="datetimepicker" name="fee_payment_date[]" autocomplete="off">
    </div>
    <div class="col-md-2">
        <label>Receipt</label>
        <input type="file" id="exampleInputFile" name="fee_receipt[]">
    </div>
    <div class="col-md-1 float-right">
    <br/>
        <button class="btn btn-sm btn-danger removeRow" type="button"> <i class="fas fa-times-circle" title="Remove Item"></i> Remove</button>
    </div>
</div>

</div>
    `;

    // var rowTemplate = document.getElementById('order_items');

    // Add new row
    $('#addRow').on('click', function () {
        $('#fees-container').append(rowTemplate);


    //Date picker
    $('.reservationdate').datetimepicker({
        format: 'MM/DD/YYYY'
        });

    // Number,Comma Separator
    $('.InputAmount').keyup(function(event) {
        if(event.which >= 37 && event.which <= 40) return;
        $(this).val(function(index, value) {
            return value
            .replace(/\D/g, "")
            .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            ;
        });
        });

    });

    // Remove row
    $('#fees-container').on('click', '.removeRow', function () {
        $(this).closest('.fees-row').remove();
    });
});

