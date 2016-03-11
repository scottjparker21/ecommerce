
$( document ).ready(function() {


	function search (inp){		
		$.get( "searching.php?entry=" + inp, function( data ) {
		  	$( ".results" ).html(data);
		});
	}

	$('#search').keyup(function() {
		var empty = '';
		var entry = $(this).val();

		if (entry === empty){
			
			$( "#content" ).show();
			$(".results").hide();

		}
		
        else if(entry !== '' && entry !== null) {
        	
        	$( "#content" ).hide();
        	$( ".results" ).show();
            	
            search(entry);
		}
	});		

});


/*
user changes search input
a function grabs the new value on change
the function calls a php page with get/ajax
the php page echos back search results
the contents of the container on the page are temporarilly stored in a variable
the contents of container are replaced with what gets echo'd back from the php
if the php doesn't echo any products, dusplay "no results"
if the search bar is empty, replace the contents of the page from the temp variable and set the variable to null


use on instead of keyup (on change)
as soon as empty string call function

*/