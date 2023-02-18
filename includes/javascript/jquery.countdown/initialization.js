/**
 * Created by ILIYA on 24.05.2017.
 */
$(document).ready(function () {
    var to_date=$('#clock>span').attr('date-to');

    $('#clock>span').countdown(to_date, function(event) {
        var $days=[CUSTOM_PANEL_DATE1, CUSTOM_PANEL_DATE2, CUSTOM_PANEL_DATE3];
        $(this).html(event.strftime('%-D '+ getNumEnding(event.offset.totalDays,$days) +' %H:%M:%S'));
        // if(event.offset.hours==0 && event.offset.minutes==0 && event.offset.seconds==0){
        //
        // }
    });

});

function getNumEnding(iNumber, aEndings){
    var sEnding, i;
    iNumber = iNumber % 100;
    if (iNumber>=11 && iNumber<=19) {
        sEnding=aEndings[2];
    }
    else {
        i = iNumber % 10;
        switch (i)
        {
            case (1): sEnding = aEndings[0]; break;
            case (2):
            case (3):
            case (4): sEnding = aEndings[1]; break;
            default: sEnding = aEndings[2];
        }
    }
    return sEnding;
}

// x = new Date();
// Math.abs(x.getTimezoneOffset()/60);