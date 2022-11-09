$(document).ready(function (e) {
    $('.see-more').click(function () {
        var choice = $(this).find('.choice-modal');
        // console.log(this);
        // console.log(choice);
        if (choice.css("display") == "none") {
            choice.css("display", "block");
        } else {
            choice.css("display", "none");
        }

    });

    //When clicked outside hide
    $(document).mouseup(function (e) {
        var container = $(this).find('.choice-modal');

        // If the target of the click isn't the container
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            container.hide();
        }
    });

    //Show Delete modal
    $('.delete-button').click(function () {
        $('#delete-modal').modal('toggle');
        var courseTitle = $(this).parents('.data-record').find('.title').data('course-title');
        var courseType = $(this).parents('.data-record').find('.course-type').data('course-type');
       
        $('#delete-modal').find(".course-title").html(courseTitle);
        $('#delete-modal').find(".course-type").html(courseType);
    });

    


    // Show Schedule modal
    $('.schedule-button').click(function () {
        // Show modal
        $('#schedule-modal').modal('toggle');

        var courseTitle = $(this).parents('.data-record').find('.title').data('course-title');
        $('#schedule-modal').find(".course-title").html(courseTitle);
    });
})
