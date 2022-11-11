<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://unpkg.com/bootstrap-table@1.21.1/dist/bootstrap-table.min.js"></script>
<script src="https://kit.fontawesome.com/aca3ebed9c.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
<script src="https://unpkg.com/jspdf-autotable@3.5.22/dist/jspdf.plugin.autotable.js"></script>
<script>

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
                1: {columnWidth: 'auto'}
              }
            });

            pdf.save("MySchedule.pdf");

            
        }

        function logoutPage(){
            alert("Logout!");
        }

        $('#courseModal').on('show.bs.modal', function (event){
            var selectedCourseID = $(event.relatedTarget).data('object') // Button that triggered the modal
            $.get('./controllers/AjaxRequests/GetCourseDetails.php', {"id": selectedCourseID} , function(data){
              $("#course-details").html(data);
            });
        });
    </script>