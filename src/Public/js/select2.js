$('#map_categories').select2({
    placeholder: "Choose categories...",
    minimumInputLength: 2,
    ajax: {
        url: '/workscategories/find',
        dataType: 'json',
        data: function (params) {
            return {
                q: $.trim(params.term)
            };
        },
        processResults: function (data) {
            return {
                results: data
            };
        },
        cache: true
    }
});