// jQuery().ready(function() {
//     jQuery("#bem").autocomplete("model/listabem.php", {
//         width: 300,
//         matchContains: true,
//         //mustMatch: true,
//         minChars: 2,
//         //multiple: true,
//         //highlight: false,
//         //multipleSeparator: ",",
//         selectFirst: false
//     });
// });

// jQuery().ready(function() {
//     jQuery("#setor").autocomplete("model/listasetor.php", {
//         width: 300,
//         matchContains: true,
//         //mustMatch: true,
//         //minChars: 0,
//         //multiple: true,
//         //highlight: false,
//         //multipleSeparator: ",",
//         selectFirst: false
//     });
// });

jQuery('#bem').autocomplete({
    minChars: 2,
    serviceUrl: 'model/listabem.php',
    onSearchComplete: function (query, suggestions) {
    },
    transformResult: function(response, originalQuery) {
        var retData = JSON.parse(response);
        return {
             suggestions: $.map(retData.data, function(dataItem) {
                return { value: dataItem.value};
            })
        };
    },
    onSelect: function (suggestion) {
    }
});