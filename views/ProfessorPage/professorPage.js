// Click the trash can and open the modal

$(document).ready(function () {
    $('#showModal').click(function () {
        $('#staticBackdrop').modal('show');
    });
})

// Click a list element and open/close the schedule card

$(document).ready(function () {
    $('.list-group-item').click(function () {
        $('#card').toggle();
    });
})

// // Responsive datepicker

let now = new Date();
let day = ("0" + now.getDate()).slice(-2);
let month = ("0" + (now.getMonth() + 1)).slice(-2);
let today = (day) + "/" + (month) + "/" + now.getFullYear();

$(document).ready(function () {
    $('#fromDateId').datepicker({
        firstDayOfWeek: 1,
        outputFormat: 'dd/MM/yyyy',
        daysOfWeekDisabled: [0, 6],
        next: '#toDateId'
    });
    $('#toDateId').datepicker({
        firstDayOfWeek: 1,
        outputFormat: 'dd/MM/yyyy',
        daysOfWeekDisabled: [0, 6],
        previous: '#fromDateId'
    });
});

$(document).ready(function () {
    $('#fromDateId').val(today);
    $('#toDateId').val(today);
})

