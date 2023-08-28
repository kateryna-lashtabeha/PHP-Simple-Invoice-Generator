import { filterProjectInfo, filterTrucks, filterLabours } from './utils.js';

$(document).ready(function () {
    // dynamic rows
    $(document).on('click', '.row-button', function (event) {
        event.preventDefault();
        let el = $(this).parents(".dynamic-list");

       if ($(this).hasClass("add-group")) {
            el.clone().insertAfter( $( this ).parents(".dynamic-list") );
        }
        else if ($(this).hasClass("remove-group") &&  el.siblings().length > 2) {
            el.remove();
        }
        if (el.hasClass('labourRow')) $("#labourSubtotal").val(getTotalLabour());
        else if (el.hasClass('truckRow')) $("#truckSubtotal").val(getTotalTruck());
        else if (el.hasClass('miscRow')) $("#miscSubtotal").val(getTotalMisc());
    });

    // filtering of options for project information section
    $("#customerName").change(function () {
        let fieldID = $(this).val();
           filterProjectInfo(fieldID, 'customer', '#jobName', '#locationName', 'jobs', 'location');
    });

    $("#jobName").change(function () {
        let fieldID = $(this).val();
        filterProjectInfo(fieldID, 'jobs', '#customerName', '#locationName', 'customer', 'location');

    });

    $("#locationName").change(function () {
        let fieldID = $(this).val();
        filterProjectInfo(fieldID, 'location', '#customerName', '#jobName', 'customer', 'jobs',
            () => {
            console. log('sasd', $("#jobName").val(),  $("#customerName").val())
        });
        
        
    });

    // filtering Labour section
   $(document).on('change', ".staffName",function () {
        let fieldID = $(this).val();
        let resElement = $(this).closest(".labourRow").find(".positionName");
        filterLabours([fieldID], 'staff', 'staff', resElement);

    });

    $(document).on('change', ".positionName", function () {
        let selectEl = $(this).closest(".labourRow").find(".labourUnitsMeasure");
        if (selectEl.children().siblings().length === 0) {
            selectEl.append('<option value="hourly">Hourly</option><option value="fixed">Fixed</option>');
        }

        $(this).closest(".labourRow").find(".labourUnitsMeasure").trigger('change');
    });

   $(document).on('change', ".labourUnitsMeasure", function () {
        let fieldID = $(this).val();
        let positionVal = $(this).closest(".labourRow").find(".positionName").val();
        let regRateEl = $(this).closest(".labourRow").find(".regularRate-wrapper");
        let overtimeRateEl = $(this).closest(".labourRow").find(".overtimeRate-wrapper");
       if (fieldID) {
        filterLabours([fieldID, positionVal], 'staff', 'regular', regRateEl, () => $("#labourSubtotal").val(getTotalLabour()));
        filterLabours([fieldID, positionVal], 'staff', 'overtime', overtimeRateEl, () => $("#labourSubtotal").val(getTotalLabour()));

        }

   });

    // Labour section sub-total
    $(document).on('change', ".regHours, .overtimeHours", function () {
        $("#labourSubtotal").val(getTotalLabour());
    });

    function getTotalLabour() {
        let sum = 0;
        $("#labour-section .labourRow").each(function (i, el) {
            sum += $(el).find(".regularRate").val()
                * $(el).find(".regHours").val()
                + $(el).find(".overtimeRate").val()
                * $(el).find(".overtimeHours").val();
        });
        return sum;
    }

    // filtering Truck section
   $(document).on('change', ".truckLabel",function () {
       let selectEl = $(this).closest(".truckRow").find(".truckUnitsMeasure");
        if (selectEl.children().siblings().length === 0) {
            selectEl.append('<option value="hourly">Hourly</option><option value="fixed">Fixed</option>');
       }

        $(this).closest(".truckRow").find(".truckUnitsMeasure").trigger('change');

    });

    $(document).on('change', ".truckUnitsMeasure", function () {
        let fieldID = $(this).val();
        let truckId = $(this).closest(".truckRow").find(".truckLabel").val();
        let rateEl = $(this).closest(".truckRow").find(".truckRate-wrapper");
        if (fieldID) {
            filterTrucks([fieldID, truckId], 'truck', 'rate', rateEl, getTotalTruck,
                () => $("#truckSubtotal").val(getTotalTruck())
            );
        }
    });

    $(document).on('change', ".truckQuantity", function () {
        $("#truckSubtotal").val(getTotalTruck());
    });
    $(document).on('change', ".truckRate", function () {
        console.log('change');
        let sum = getTotalTruck();
        console.log('sum', sum);
        $("#truckSubtotal").val(getTotalTruck());
    });


    function getTotalTruck() {
        let sum = 0;
        $("#truck-section .truckRow").each(function (i, el) {
            let rowTotal = $(el).find(".truckQuantity").val()
                * $(el).find(".truckRate").val();

            $(el).find(".truckTotal").val(rowTotal);

            sum += rowTotal;

        });
        return sum;
    }

    // Miscellaneous section total count
    $(document).on('change', ".miscPrice, .miscQuantity", function () {
        $("#miscSubtotal").val(getTotalMisc());
    });

    function getTotalMisc() {
        let sum = 0;
        $("#misc-section .miscRow ").each(function (i, el) {
            let rowTotal = $(el).find(".miscPrice").val()
                * $(el).find(".miscQuantity").val();

            $(el).find(".miscTotal").val(rowTotal);

            sum += rowTotal;

        });
        return sum;
    }

    // SUBMIT
    $("#submit-invoice").submit(function (e) {
        e.preventDefault();

        let labourArr = [], truckArr = [], miscArr = [];

        $("#labour-section .labourRow").each(function (i, el) {
            let labourObj = {};

            labourObj['staff'] = $(el).find("select[name=staff]").val();
            labourObj['position'] = $(el).find("select[name=position]").val();
            labourObj['labour-units'] = $(el).find("select[name=labour-units]").val();
            labourObj['reg-hours'] = $(el).find("input[name=reg-hours]").val();
            labourObj['overtime-hours'] = $(el).find("input[name=overtime-hours]").val();
            labourObj['reg-rate'] = $(el).find("input[name=reg-rate]").val();
            labourObj['overtime-rate'] = $(el).find("input[name=overtime-rate]").val();

            labourArr.push(labourObj);
        });

        $("#truck-section .truckRow").each(function (i, el) {
            let truckObj = {};
            truckObj['truck-label'] = $(el).find("select[name=truck-label]").val();
            truckObj['truck-quantity'] = $(el).find("input[name=truck-quantity]").val();
            truckObj['truck-units'] = $(el).find("select[name=truck-units]").val();
            truckObj['truck-rate'] = $(el).find("input[name=truck-rate]").val();

            truckArr.push(truckObj);
        });

        $("#misc-section .miscRow").each(function (i, el) {
            let miscObj = {};

            miscObj['misc-descr'] = $(el).find("input[name=misc-descr]").val();
            miscObj['misc-cost'] = $(el).find("input[name=misc-cost]").val();
            miscObj['misc-price'] = $(el).find("input[name=misc-price]").val();
            miscObj['misc-quantity'] = $(el).find("input[name=misc-quantity]").val();

            miscArr.push(miscObj);
        });

        let formData = {
            project: [{
                customer: $('select[name=customer]').val(),
                job: $('select[name=job]').val(),
                status: $('select[name=status').val(),
                location: $('select[name=location').val(),
                orderedBy: $('input[name=orderedBy').val(),
                date: $('input[name=date').val(),
                area: $('input[name=area').val(),
                description: $('textarea[name=description').val(),
            }],
            labour: labourArr,
            trucks: truckArr,
            misc: miscArr

        };

        $.ajax({
            type: 'POST',
            url: "../test-single-page-app/app/backend/php_scripts/submit-invoice.php",
            data: formData,
            dataType: "text",
            encode: true,

            error: function (err) {
                console.log('error', err);
            },

            success: function(response) {
                if (response === "success") {
                    if ($("#error-message").length) $("#error-message").remove();
                    alert("Invoice generated");
                    // window.location.reload();
                    window.location.href = "index.php";
                    location.reload(true);
                }
                else {
                    if ($("#error-message").length) $("#error-message").remove();
                    $("#submit-section").before(response);
                }
            },
        });
    })

});
