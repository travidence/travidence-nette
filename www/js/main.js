$().ready(function () {
    /*$("btn").click(function () {
        var elements = $(".greyzone");
        var last = elements[elements.length - 1];
        last.insertAfter(element);
        console.log(element);
    });*/

    window.rest = new RestAdapter();

    function RestAdapter(baseUrl) {
        this.$baseUrl = baseUrl || '';


        this.post = function (path, data) {
            return this.request('POST', path, data)
                .then(unwrapResponse);
        };

        this.request = function request(method, path, data) {
            return $.ajax({
                method: method,
                url: this.$baseUrl + '/' + path,
                data: JSON.stringify(data)
            });
        };

        function unwrapResponse(promise) {
            return promise
                .then(function (result) {
                    return result;
                })
                .catch(function (error) {
                    throw error.responseJSON.data;
                });
        }
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


