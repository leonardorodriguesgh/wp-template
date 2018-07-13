var countdown = {
    startInterval : function() {
        var count = 5; // 30 minute timeout
        var currentId = setInterval(function(){
            $('#currentSeconds').html(count);
            if(count == 30) { // when there's thirty seconds...
                $('#expireDiv').slideDown().click(function() {
                        clearInterval(countdown.intervalId);
                        $('#expireDiv').slideUp();                      
                        window.location.reload();
                });
            }
            if (count == 0) {
               window.location.href = 'http://lisieuxtreinamento.com.br/';
            }
            --count;
        }, 1000);
        countdown.intervalId = currentId;
    }
};
countdown.startInterval();

/*
Then each time an ajax call is made to fetch a page
*/
if(typeof countdown.oldIntervalId != 'undefined') {
        countdown.oldIntervalId = countdown.intervalId;
        clearInterval(countdown.oldIntervalId);
        countdown.startInterval();
        $('#expireDiv').slideUp();
    } else {
        countdown.oldIntervalId = 0;
    }