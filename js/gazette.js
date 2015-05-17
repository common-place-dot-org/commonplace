jQuery(document).ready(function($) {
// sam.. why is this here? commented out. - ab 
//jQuery("#searchsubmit").attr("value", "Submit");


	function bsearchformBootstrapper(){
		$('.bsearchform').each(function(){
			$(this).children('.s').addClass('form-control');
			$(this).children('.searchsubmit').addClass('btn btn-primary').attr('value', 'Search');
			$(this).addClass('form-group').addClass('form-inline');
		});	
	}
	
	function bsearchformResultsFormat(){
		$('.bsearch_nav').insertAfter('.bsearch_footer');
	}
	
	
	bsearchformBootstrapper();
	bsearchformResultsFormat();
	
});
