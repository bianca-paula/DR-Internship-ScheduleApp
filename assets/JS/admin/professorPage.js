$(document).ready(function () {

    // Click the trash can and open the modal
    $('#showModal').click(function () {
        $('#staticBackdrop').modal('show');
    });


    // Click a list element and open/close the schedule card
    $('.list-group-item-action').click(function () {
        $('.card').toggle();
    });

    // Responsive datepicker

    let now = new Date();
    let day = ("0" + now.getDate()).slice(-2);
    let month = ("0" + (now.getMonth() + 1)).slice(-2);
    let today = (day) + "/" + (month) + "/" + now.getFullYear();

    $('#fromDateId').datepicker({
        startDate: today,
        firstDayOfWeek: 1,
        outputFormat: 'dd/MM/yyyy',
        daysOfWeekDisabled: [0, 6],
        next: '#toDateId'
    });

    $('#toDateId').datepicker({
        startDate: today,
        firstDayOfWeek: 1,
        outputFormat: 'dd/MM/yyyy',
        daysOfWeekDisabled: [0, 6],
        previous: '#fromDateId'
    });

    $('#fromDateId').val(today);
    $('#toDateId').val(today);
})


// Generate PDF

function downloadPDF(){
    alert("Download PDF!");
    var pdfsize = 'a0';
    var pdf = new jsPDF('l', 'pt', pdfsize);

    pdf.autoTable({
      html: '#schedule-table',
      startY: 60,
      styles: {
        fontSize: 50,
        cellWidth: 'wrap',
        fillColor: [172, 112, 136]

      },
      columnStyles: {
        1: {cellWidth: 'auto'}
      }
    });

    pdf.save("MySchedule.pdf");
}


// LOGOUT

function logoutPage(){
    alert("Logout!");
}
