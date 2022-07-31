// var eventTable = ;
$(document).ready(function(){

    $('#table-event').DataTable()
    $('#table-event').on( 'draw.dt', function () {
        feather.replace();
    } );
    flatpickr(".flatpickr-datetime", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
    });
    
   getEvent();
}); 


var eventData = [];

const getEvent = () => {
    var res =  fetchApi('admin-api/v1/ticket','GET');
    setEvent(res.data);
}

const setEvent = (data) => {
    let html = ''
    $('#table-event').DataTable().destroy();

    data.forEach((value, i) => {

        var name = "<td>" + value.name + "</td>"
        var expired_at = "<td>" + moment(value.expired_at).format('MM/DD/YYYY') + "</td>"
        var editAct =
            "<a href='#' class='me-3'><i class='align-middle' data-feather='edit-2' data-event-id='" +
            value.id +
            "' id='btn-edit-modal' data-bs-toggle='modal' data-bs-target='#updateModal'></i></a>"
        var deleteAct =
            "<a href='#'><i class='align-middle' data-feather='trash' data-bs-toggle='modal' data-event-id='" +
            value.id + "' id='btn-delete-modal' data-bs-target='#deleteModal'></i></a>"
        var actions = "<td class='table-action'>" + editAct + deleteAct + "</td> "

        html += '<tr data-ticket-id=' + value.id + '>' + name + expired_at + actions + '</tr>'
    })
    
    $('#table-event').find('tbody').html(html)
    $('#table-event').DataTable().draw();
    
 
}


$('#form-ticket').on('submit', function (e) {
    e.preventDefault()
    var formData = new FormData(document.querySelector('#form-ticket'))
    var res = fetchApi('admin-api/v1/ticket','POST',formData);
    if (res.success) {
        getEvent();
        showNotif(res.message,'success')
        $('#form-ticket')[0].reset();
    }else{
        console.log('====================================');
        console.log(res);
        console.log('====================================');
        showNotif(res.message,'danger')
    }
    // var settings = {
    //     "url": "http://127.0.0.1:8000/admin-api/v1/ticket",
    //     "method": "POST",
    //     "dataType": "json",
    //     "timeout": 0,
    //     "headers": {
    //         "x-api-key": "UqK3adl3ZOGTiEMxpQPhovMY26ir3R6D26XY2fcqBe7usjkXsXOuchu3HI3CasQtD3LIArMvCxNaUAaBdW3orvOA1iYmyFVqw2h3"
    //     },
    //     "processData": false,
    //     "mimeType": "multipart/form-data",
    //     "contentType": false,
    //     "data": formData
    // };



    // $.ajax(settings).done(function (response) {
    //     eventData[0].push(response.data)
    //     setEvent()
    //     var message = "Tambah Event Sukses";
    //     var type = 'default';
    //     var duration = 5000;
    //     var dismissible = 'Dismissible';
    //     var positionX = 'right';
    //     var positionY = 'top';
    //     window.notyf.open({
    //         type,
    //         message,
    //         duration,
    //         dismissible,
    //         position: {
    //             x: positionX,
    //             y: positionY
    //         }
    //     });
    // }).fail(function (response) {
        
    // });
});


// //showData
// var settings = {
//     "url": "http://127.0.0.1:8000/admin-api/v1/ticket",
//     "method": "GET",
//     "timeout": 0,
//     "headers": {
//         "x-api-key": "UqK3adl3ZOGTiEMxpQPhovMY26ir3R6D26XY2fcqBe7usjkXsXOuchu3HI3CasQtD3LIArMvCxNaUAaBdW3orvOA1iYmyFVqw2h3"
//     },
// };
// $.ajax(settings).done(function (response) {
//     eventData.push(response.data.data)
//     setEvent()

// });


// $(document).on('click', '#btn-edit-modal', function () {
//     const id = $(this).data('event-id')
//     const event = eventData[0].find(ticket => ticket.id == id)
//     $('#updateModal #input-name-update').val(event.name)
//     $('#updateModal #input-expired-update').val(moment.utc(event.expired_at).format('MM/DD/YYYY hh:mm'))
//     $('#btn-update-modal').data('ticket-id', id)
// })
// $(document).on('click', '#btn-update-modal', function () {
//     const id = $(this).data('ticket-id')
//     const event = eventData[0].find(event => event.id == id)
//     var formData = new FormData(document.querySelector('#form-ticket-update'))

//     var settings = {
//         "url": "http://127.0.0.1:8000/admin-api/v1/ticket/" + id,
//         "method": "POST",
//         "timeout": 0,
//         "dataType": "json",
//         "headers": {
//             "x-api-key": "UqK3adl3ZOGTiEMxpQPhovMY26ir3R6D26XY2fcqBe7usjkXsXOuchu3HI3CasQtD3LIArMvCxNaUAaBdW3orvOA1iYmyFVqw2h3"
//         },
//         "processData": false,
//         "mimeType": "multipart/form-data",
//         "contentType": false,

//         "data": formData
//     };

//     $.ajax(settings).done(function (response) {
//         console.log(response);
//         eventData[0] = eventData[0].map(v => {
//             if (JSON.stringify(v) === JSON.stringify(event)) {
//                 return response.data
//             } else {
//                 return v
//             }
//         })
//         setEvent()
//         var message = response.message;
//         var type = 'success';
//         var duration = 5000;
//         var dismissible = 'Dismissible';
//         var positionX = 'right';
//         var positionY = 'top';
//         window.notyf.open({
//             type,
//             message,
//             duration,
//             dismissible,
//             position: {
//                 x: positionX,
//                 y: positionY
//             }
//         });

//     });
// })


// //deleteData
// $(document).on('click', '#btn-delete-modal', function () {
//     const id = $(this).data('event-id')


//     $('#btn-delete-ticket').data('ticket-id', id)
// })
// $(document).on('click', '#btn-delete-ticket', function () {
//     const id = $(this).data('ticket-id');
//     var settings = {
//         "url": "http://127.0.0.1:8000/admin-api/v1/ticket/" + id,
//         "method": "DELETE",
//         "timeout": 0,
//         "dataType": "json",
//         "headers": {
//             "x-api-key": "UqK3adl3ZOGTiEMxpQPhovMY26ir3R6D26XY2fcqBe7usjkXsXOuchu3HI3CasQtD3LIArMvCxNaUAaBdW3orvOA1iYmyFVqw2h3"
//         },
//     };

//     $.ajax(settings).done(function (response) {
//         $(`#table-event tbody tr[data-ticket-id="${id}"]`).remove()
//         var message = response.message;
//         var type = 'default';
//         var duration = 5000;
//         var dismissible = 'Dismissible';
//         var positionX = 'right';
//         var positionY = 'top';
//         window.notyf.open({
//             type,
//             message,
//             duration,
//             dismissible,
//             position: {
//                 x: positionX,
//                 y: positionY
//             }
//         });
//     });
// })
