import './style.scss';
import './editor.scss';
import edit from './edit';
// import save from './save';
import attributes from './attributes';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;

registerBlockType( 'in-2019/site-creation', {
	title: __( 'Tabs', 'in-2019' ),
	category: 'nikitin',
	supports: {
		anchor: true,
	},
	attributes,
	getEditWrapperProps( { blockAlignment } ) {
		if ( 'full' === blockAlignment || 'wide' === blockAlignment || 'center' === blockAlignment ) {
			return { 'data-align': blockAlignment };
		}
	},
	edit,
	save: () => {
		return null;
	},
} );
