
function fetchApi(path, method, data) {
    var settings = {
        "url": config.BASE_URL + path,
        method,
        "async": false,
        "dataType": 'json',
        "headers": {
            "x-api-key": config.X_API_KEY
        },
        "processData": false,
        "contentType": false,
        data
    };
    return $.ajax(settings).responseJSON;
}

function showNotif(message,type) {
    var duration = 5000;
    var dismissible = 'Dismissible';
    var positionX = 'right';
    var positionY = 'top';
    window.notyf.open({
        type,
        message,
        duration,
        dismissible,
        position: {
            x: positionX,
            y: positionY
        }
    });
}


