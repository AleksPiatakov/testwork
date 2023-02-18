var client;
function googleStartAuth() {
    client = google.accounts.oauth2.initCodeClient({
        client_id: googleClientID,
        scope: 'https://www.googleapis.com/auth/userinfo.profile \ https://www.googleapis.com/auth/userinfo.email',
        ux_mode: 'popup',
        callback: (authResult) => {
            if(authResult['code']) {
                $.ajax({
                    type: 'POST',
                    url: googleRedirectUri,
                    dataType: 'json',
                    data: {
                        code: authResult['code']
                    },
                    success: function (result) {
                        if(result.success) {
                            checkLoginvk(result.id, result.firstname, result.lastname, result.picture, result.email, '', '');
                        } else {
                            console.log(result.message);
                        }
                    }
                });
            } else {
                console.log('Error google authResult');
            }
        },
    });
    client.requestCode();
}

function startGoogleOAuth() {
    var script = '&lt;script src="https://accounts.google.com/gsi/client" async defer>&lt;\/script>';
    $('body').append(script.replace(/&lt;/g, '<'));
    // add timeout because onload don't worked
    setTimeout(googleStartAuth, 500);
}

$(document).on('click', '.googleSigninButton', startGoogleOAuth);
