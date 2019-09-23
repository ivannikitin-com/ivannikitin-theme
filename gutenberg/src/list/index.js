import './item';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { InnerBlocks } = wp.editor;

const ALLOWED_BLOCKS = [ 'in-2019/item-list' ];
const TEMPLATE = [ [ 'in-2019/item-list' ] ];

registerBlockType( 'in-2019/list', {
	title: __( 'List', 'in-2019' ),
	category: 'nikitin',
	edit: ( { className } ) => {
		return (
			<div className={ className }>
				<InnerBlocks allowedBlocks={ ALLOWED_BLOCKS } template={ TEMPLATE } templateLock={ false } />
			</div>
		);
	},
	save: () => {
		return (
			<div>
				<InnerBlocks.Content />
			</div>
		);
	},
} );
