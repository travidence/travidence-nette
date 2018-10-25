var element;


$().ready(function () {
    element = document.getElementsByClassName("greyzone")[0];

    /*$("btn").click(function () {
        var elements = $(".greyzone");
        var last = elements[elements.length - 1];
        last.insertAfter(element);
        console.log(element);
    });*/

    $('.btn-submit-trip').on('click', function (event) {
        event.preventDefault();

        var data = collectFormData($('#frm-tripForm-form'));

        $.post({
            url: '/api/trip',
            data: JSON.stringify({trip: data})
        })
            .then(function (result) {
                console.log(result);
            })
            .catch(function (error) {
                console.error(error.responseJSON.data);
            });
    });

    function collectFormData(form) {
        var data = form.serializeObject();
        console.log(form[0]);

        data.segments = data.segments.map(function (/**Object*/ segment, i) {
            var date = segment.date;

            var startTime = segment.startTime;
            var endTime = segment.endTime;

            if(!date) {
                throw new Error("value_invalid segment[" + i + "].date");
            }
            if(!startTime) {
                throw new Error("value_invalid segment[" + i + "].startTime");
            }
            if(!endTime) {
                throw new Error("value_invalid segment[" + i + "].endTime");
            }

            console.groupCollapsed("Segment " + i);
            console.log(date);
            console.log(startTime, endTime);
            console.groupEnd();

            segment.startDate = date + " " + startTime;
            segment.endDate = date + " " + startTime;

            delete segment.startTime;
            delete segment.endTime;

            return segment;
        });


        console.log(data);

        return data;
    }

    /**
     * Taken from https://stackoverflow.com/questions/1184624/convert-form-data-to-javascript-object-with-jquery
     */
    $.fn.serializeObject = function () {

        var self = this,
            json = {},
            push_counters = {},
            patterns = {
                "validate": /^[a-zA-Z][a-zA-Z0-9_]*(?:\[(?:\d*|[a-zA-Z0-9_]+)\])*$/,
                "key": /[a-zA-Z0-9_]+|(?=\[\])/g,
                "push": /^$/,
                "fixed": /^\d+$/,
                "named": /^[a-zA-Z0-9_]+$/
            };


        this.build = function (base, key, value) {
            base[key] = value;
            return base;
        };

        this.push_counter = function (key) {
            if (push_counters[key] === undefined) {
                push_counters[key] = 0;
            }
            return push_counters[key]++;
        };

        $.each($(this).serializeArray(), function () {

            // skip invalid keys
            if (!patterns.validate.test(this.name)) {
                return;
            }

            var k,
                keys = this.name.match(patterns.key),
                merge = this.value,
                reverse_key = this.name;

            while ((k = keys.pop()) !== undefined) {

                // adjust reverse_key
                reverse_key = reverse_key.replace(new RegExp("\\[" + k + "\\]$"), '');

                // push
                if (k.match(patterns.push)) {
                    merge = self.build([], self.push_counter(reverse_key), merge);
                }

                // fixed
                else if (k.match(patterns.fixed)) {
                    merge = self.build([], k, merge);
                }

                // named
                else if (k.match(patterns.named)) {
                    merge = self.build({}, k, merge);
                }
            }

            json = $.extend(true, json, merge);
        });

        return json;
    };
});


