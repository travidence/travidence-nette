var $tripFormReady = false;
$(document).ready(function () {
    // for some reason the .ready() fires twice
    if ($tripFormReady) {
        return;
    }
    $tripFormReady = true;

    var $segments = $('.trip-segments');

    var segmentTemplate = extractTemplate('.trip-segment');
    addSegment(0);


    $('.btn-submit-trip').on('click', function (event) {
        event.preventDefault();

        var data = collectFormData($('#frm-tripForm-form'));

        window.rest.post('api/trip', {trip: data})
            .then(function (result) {
                console.log(result);
            })
            .catch(function (error) {
                console.error(error.responseJSON.data);
            });
    });

    $('.btn-add-segment').on('click', function () {
        addSegment($('.trip-segment').length);
    });

    $segments.on('click', '.btn-remove-segment', function () {
        var $tel = $(this);
        console.log($tel);
        var $segmentEl = $tel.closest('.trip-segment');
        console.log($segmentEl);

        $segmentEl.remove();
    });

    function collectFormData(form) {
        var data = form.serializeObject();

        data.segments = data.segments.map(function (/**Object*/ segment, i) {
            var date = segment.date;

            var startTime = segment.startTime;
            var endTime = segment.endTime;

            if (!date) {
                throw new Error("value_invalid segment[" + i + "].date");
            }
            if (!startTime) {
                throw new Error("value_invalid segment[" + i + "].startTime");
            }
            if (!endTime) {
                throw new Error("value_invalid segment[" + i + "].endTime");
            }

            segment.startDate = date + " " + startTime;
            segment.endDate = date + " " + startTime;

            delete segment.startTime;
            delete segment.endTime;

            return segment;
        });


        // console.log(data);

        return data;
    }


    function extractTemplate(selector) {
        var $el = $(selector);
        $el.detach();

        var outer = $('<div>').append($el);

        return outer.html();
    }

    function addSegment(n) {
        var reIndexedTemplate = segmentTemplate.replace(/420/g, n);
        $segments.append($(reIndexedTemplate));
    }
});