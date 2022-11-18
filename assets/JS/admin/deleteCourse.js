$(document).ready(function () {
    $('#delete-course').submit(function (event) {
        event.preventDefault();

        var form = $(this).serializeArray();
        const obj = {};
        for (let i = 0; i < form.length; i++) {
            obj[form[i].name] = form[i].value;
        }

        $.post('admin/delete-course', obj, function (res) {
            if (res) {
                //refresh page to query db to show the new course
                location.reload();
            }
        })

    })

})