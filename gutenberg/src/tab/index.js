import edit from './edit';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;

const { InnerBlocks } = wp.editor;

registerBlockType( 'in-2019/tab', {
	title: __( 'Tab', 'in-2019' ),
	category: 'nikitin',
	parent: [ 'in-2019/tabs' ],
	attributes: {
		id: {
			type: 'number',
			default: 1,
		},
		uniqueID: {
			type: 'string',
			default: '',
		},
	},
	supports: {
		inserter: false,
		reusable: false,
		html: false,
	},
	getEditWrapperProps( attributes ) {
		return { 'data-tab': attributes.id };
	},
	edit,
	save: ( { attributes } ) => {
		const { id } = attributes;
		return (
			<div className={ `in-tab-inner-content in-inner-tab-${ id }` }>
				<div className="in-tan-inner-content-inner">
					<InnerBlocks.Content />
				</div>
			</div>
		);
	},
} );
