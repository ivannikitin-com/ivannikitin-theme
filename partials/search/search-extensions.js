/**
 * Раширения поиска для сайта ivannikitin.com
 */
jQuery(function($){
	'use strict';
	
	var debug = true,
		cpm_abort;

	debug && console.log('in-search-extensions');

	// Если есть CPM, то есть переменная CPM_Vars
	if ( CPM_Vars )
	{
		$( "#txtSearch" )
			.autocomplete({
					minLength: 1,
					source: function( request, response ) {
						var self = this.element;
						var data = {
							action: 'all_search',
							item: request.term,
							project_id: self.data( 'project_id' ),
							is_admin: CPM_Vars.is_admin
						};
						if ( cpm_abort ) {
							cpm_abort.abort();
						}

						cpm_abort = $.post( CPM_Vars.ajaxurl, data, function( resp ) {

							if ( resp.success ) {
								var nme = eval( resp.data );
								response( eval( resp.data ) );
							} else {
								response( '' );
							}

						} );
					},
					select: function( event, ui ) {
						$( this ).val( "" );
						return false;
					}
				})
			.data( "ui-autocomplete" )._renderItem = function( ul, item ) {
                return $( "<li>" )
                        .append( item.label )
                        .appendTo( ul );
				};
	}
	
});