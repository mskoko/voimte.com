// add the "hover" class when got focus
function view_s_box() {
	$('.s_prjct input').removeClass('s_not_act1');
	$('.s_prjct span').removeClass('s_not_act2');

	$('.s_box').fadeIn(5);
};

$('#s_prjct').mouseleave(function() {
    $('.s_prjct input').addClass('s_not_act1');
    $('.s_prjct span').addClass('s_not_act2');

    $('.s_box').fadeOut(5);
});

//Search function
function s_muky(s_muky) {
	//document.getElementById('s_result').innerHTML = s_muky;
	$.ajax({
        url: '/process?s',
        dataType: 'text',
        type: 'POST',
        contentType: 'application/x-www-form-urlencoded',
        data: 's='+s_muky+'',
        success: function( data, textStatus, jQxhr ){
            document.getElementById('s_result').innerHTML = data;
            console.log('search '+s_muky);
        },
        error: function( jqXhr, textStatus, errorThrown ){
            console.log( errorThrown );
        }
    });
}

$( document ).ready(function() {
    setTimeout(function(){
        $('.alert_cookies').fadeIn(500)
    }, 2500);
});

function cookie_alert(isAorD) {
    if (isAorD == '') {
        alert('Sorry, we detect a problem.. Please reload the page.');
    } else {
        $.ajax({
            url: '/process?cookie_alert',
            dataType: 'text',
            type: 'POST',
            contentType: 'application/x-www-form-urlencoded',
            data: 'isAorD='+isAorD+'',
            success: function( data, textStatus, jQxhr ){
                $('.alert_cookies').fadeOut(200);
            },
            error: function( jqXhr, textStatus, errorThrown ){
                console.log( errorThrown );
            }
        });
    }
}

var mobile = (/iphone|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));
if (mobile) {
    $('.left_ads').hide();
    $('.right_ads').hide();

    $('.hide_For_mobile').hide();

    var hideforPhoneElements = document.getElementsByClassName('hide_for_phone');

    for (var i = 0; i < hideforPhoneElements.length; i++) {
        hideforPhoneElements[i].style.display = 'none';
    }
} else {
    $('.hide_for_desktop').show();

    var hideforDesktopElements = document.getElementsByClassName('hide_for_desktop');

    for (var i = 0; i < hideforDesktopElements.length; i++) {
        hideforDesktopElements[i].style.display = 'none';
    }
}

//Remove
if (mobile) {
    var removeForPhoneElements = document.getElementsByClassName('remove_for_desktop');

    for (var i = 0; i < removeForPhoneElements.length; i++) {
        removeForPhoneElements[i].remove();
    }
} else {
    var removeForDesktopElements = document.getElementsByClassName('remove_for_phone');

    for (var i = 0; i < removeForDesktopElements.length; i++) {
        removeForDesktopElements[i].remove();
    }
}
function pEdit(pID) {
    if (isNaN(pID) || pID == '') {
        return false;
    } else {
        document.location.href = '/post?w='+pID;
    }
}

function my_love() {
    $('#my_quizz').fadeOut(300);
    //////////////////////////
    $('#my_love_p').fadeIn(300);
    $('#my_love').fadeIn(300);

}

function my_quizz() {
    $('#my_love_p').fadeOut(300);
    $('#my_love').fadeOut(300);
    //////////////////////////
    $('#my_quizz').fadeIn(300);
}

function like_this_post(pID) {
    if(pID == '') {
        alert('Sorry.');
    } else {
        $.ajax({
            url: '/process?like_post',
            dataType: 'text',
            type: 'POST',
            contentType: 'application/x-www-form-urlencoded',
            data: 'pID='+pID,
            success: function( data, textStatus, jQxhr ) {
                $('#liked_'+pID).removeClass('fa-heart-o');
                $('#liked_'+pID).addClass('fa-heart');

                //change btn > unlike
                document.getElementById('likeThis_'+pID+'_Post').setAttribute('onclick', 'unlike_this_post('+pID+')');

                $('#i_l_p_num_'+pID+' span').html( data );
            },
            error: function( jqXhr, textStatus, errorThrown ){
                console.log( errorThrown );
            }
        });
    }
}

function unlike_this_post(pID) {
    if(pID == '') {
        alert('Sorry.');
    } else {
        $.ajax({
            url: '/process?unlike_post',
            dataType: 'text',
            type: 'POST',
            contentType: 'application/x-www-form-urlencoded',
            data: 'pID='+pID,
            success: function( data, textStatus, jQxhr ){
                $('#liked_'+pID).removeClass('fa-heart');
                $('#liked_'+pID).addClass('fa-heart-o');

                //change btn > like
                document.getElementById('likeThis_'+pID+'_Post').setAttribute('onclick', 'like_this_post('+pID+')');

                $('#i_l_p_num_'+pID+' span').html( data );
                console.log(data);
            },
            error: function( jqXhr, textStatus, errorThrown ){
                console.log( errorThrown );
            }
        });
    }
}

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

async function love_anim(post_id, num_heart) {
    if(post_id == ''||num_heart == '') {
        alert('Sorry, this Post has ben problem!');
    } else {
        //Max num is 10 heart!
        if (num_heart > 10) {
            num_heart = 10;
        }

        var i;
        for (i = 0; i < num_heart; i++) {
            
            $('#p_heart_p_'+post_id+'_b_'+i).addClass('zoomInRight');
            $('#p_heart_p_'+post_id+'_b_'+i).show();
            $('#p_heart_p_'+post_id+'_b_'+i).hide(300);
            
            await sleep(200);
        }
        //alert(post_id + ' :: ' + num_heart);
    }
}
function like_this_result(uID) {
    if(uID == '') {
        alert('Sorry.. ');
    } else {
        $.ajax({
            url: '/process.php?likeThisResult',
            dataType: 'text',
            type: 'POST',
            contentType: 'application/x-www-form-urlencoded',
            data: 'uID='+uID+'',
            success: function( data, textStatus, jQxhr ){
                $('#result_liked_'+uID+' i').removeClass('fa fa-heart-o');
                $('#result_liked_'+uID+' i').addClass('fa fa-heart');
            },
            error: function( jqXhr, textStatus, errorThrown ){
                console.log( errorThrown );
            }
        });
    }
}

function audio_or_text(Type) {
    if(Type == 'text') {
        $('#audio_por').fadeOut(0);
        $('#text_por').fadeIn(500);

        $('#text_por_btn').removeClass('btn-primary');
        $('#text_por_btn').addClass('btn-success');

        $('#audio_por_btn').removeClass('btn-success');
        $('#audio_por_btn').addClass('btn-primary');
    } else if(Type == 'audio') {
        $('#audio_por').fadeIn(500);
        $('#text_por').fadeOut(0);

        $('#text_por_btn').removeClass('btn-success');
        $('#text_por_btn').addClass('btn-primary');

        $('#audio_por_btn').removeClass('btn-primary');
        $('#audio_por_btn').addClass('btn-success');
    }
}
audio_or_text('text');

if (mobile) {
    //Mobile
    $('#starting_record').on('touchstart', function () { 
        StartingTimer();

        document.getElementById('record_start').play();

        $('#starting_record').removeClass('btn_no_rec');
        $('#starting_record').addClass('btn_rec');

        setTimeout(startRecording(), 1000);
    });

    $('#starting_record').on('touchend', function () {
        StopTimer();

        document.getElementById('record_start').play();

        $('#starting_record').removeClass('btn_rec');
        $('#starting_record').addClass('btn_no_rec');

        setTimeout(stopRecording(), 500);
    });
} else {
    //Other
    $('#starting_record').mousedown(function() {
        StartingTimer();

        document.getElementById('record_start').play();

        $('#starting_record').removeClass('btn_no_rec');
        $('#starting_record').addClass('btn_rec');

        setTimeout(startRecording(), 1000);
    });

    $('#starting_record').mouseup(function() {
        StopTimer();

        document.getElementById('record_start').play();

        $('#starting_record').removeClass('btn_rec');
        $('#starting_record').addClass('btn_no_rec');

        setTimeout(stopRecording(), 500);
    });
}

function StartingTimer() {
    StartingTimerInt = setInterval(function() {
       setTime();
    }, 1000);
}

function StopTimer() {
    setTime(true);
    clearInterval(StartingTimerInt);

    document.getElementById('minutes').innerHTML = '00';
    document.getElementById('seconds').innerHTML = '00';
}

var minutesLabel = document.getElementById('minutes');
var secondsLabel = document.getElementById('seconds');
var totalSeconds = 0;

function setTime(new_) {
    if(new_) {
        totalSeconds = -1;
    }
    ++totalSeconds;
    secondsLabel.innerHTML = pad(totalSeconds % 60);
    minutesLabel.innerHTML = pad(parseInt(totalSeconds / 60));
}

function pad(val) {
    var valString = val + "";
    if (valString.length < 2) {
        return "0" + valString;
    } else {
        return valString;
    }
}

function upVideo() {
    document.getElementById('upVideo').click();
}

function shareVideo() {
    $('#showUploadAnim').fadeIn(300);
    
    let sFile   = $('#upVideo')[0].files[0];
    let oID     = document.getElementById('oID_').value; 

    let formData = new FormData();
    formData.append('oID', oID);
    formData.append('File', sFile);

    $.ajax({
        url        : '/process?sVideo',
        type       : 'POST',
        contentType: false,
        cache      : false,
        processData: false,
        data       : formData,
        xhr        : function () {
            var jqXHR = null;
            if ( window.ActiveXObject ) {
                jqXHR = new window.ActiveXObject( "Microsoft.XMLHTTP" );
            } else {
                jqXHR = new window.XMLHttpRequest();
            }
            //Upload progress
            jqXHR.upload.addEventListener( "progress", function ( evt ) {
                if ( evt.lengthComputable ) {
                    var percentComplete = Math.round( (evt.loaded * 100) / evt.total );
                    //Do something with upload progress
                    console.log( 'Uploaded percent', percentComplete );

                    $('#fUploadStatus').width(percentComplete + '%') //update progressbar percent complete
                    $('#fUploadNum').html(percentComplete + '%'); //update status text
                }
            }, false );
            //Download progress
            jqXHR.addEventListener( "progress", function ( evt ) {
                if ( evt.lengthComputable ) {
                    var percentComplete = Math.round( (evt.loaded * 100) / evt.total );
                    //Do something with download progress
                    console.log( 'Downloaded percent', percentComplete );
                }
            }, false );
            return jqXHR;
        },
        success: function (response) {
            if(response === 'error') {
                document.location.reload();
            } else if(response === 'success') {
                document.location.reload();
            } else {
                document.location.reload();
            }
            console.log(response);
        },
        error: function (err) {
            document.location.reload();
            console.log(err);
        }
    });

    //document.getElementById('shareVideo').submit();
}

if(mobile) {
    window.onload = function() {
        // Normalize the various vendor prefixed versions of getUserMedia.
        navigator.getUserMedia = (navigator.getUserMedia ||
        navigator.webkitGetUserMedia ||
        navigator.mozGetUserMedia || 
        navigator.msGetUserMedia);

        navigator.mediaDevices.getUserMedia({ audio: true });
    }
}