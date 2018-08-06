jQuery(document).ready(function($) {
    $("#utvarp-search-music-entries-search-send").click(function() {
    	utvarp.results = null;
    	$.ajax({
    		method: 'post',
	        url: utvarp.ajax_url,
	        data: {
	            'action':'utvarp-music-entries',
	            'nonce': utvarp.nonce,
	            'from': $("#utvarp-music-entries-search-date-from").val(),
	            'to': $("#utvarp-music-entries-search-date-to").val(),
	        },
	        success:function(data) {
	        	parsed = JSON.parse(data);
	            utvarp.results = parsed.results;

	            $('#utvarp-results-table').append(
				    $.map(utvarp.results, function (entry, index) {
				    	return '<tr><td>' + entry.when + '</td><td>' + entry.song + '</td><td>' + entry.artist + '</td></tr>';
				}).join());
	        }
	    });
    });
});