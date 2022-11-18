$(document).ready(function () {
    $('#add-form').submit(function (event) {
        event.preventDefault();

        var form = $(this).serializeArray();
        const obj = {};
        for (let i = 0; i < form.length; i++) {
            obj[form[i].name] = form[i].value;
        }
        $.post('admin/add-course', obj, function (res) {
            if (res) {
                // res.status(200);
                //refresh page to query db to show the new course
                location.reload();
            }
        })

    })

})