import './style.scss';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { RichText, InnerBlocks } = wp.editor;

registerBlockType( 'in-2019/what-enter', {
	title: __( 'What enter', 'in-2019' ),
	category: 'nikitin',
	parents: [ 'in-2019/carousel' ],
	attributes: {
		id: {
			type: 'number',
			default: 1,
		},
		title: {
			type: 'string',
			default: __( 'Title', 'in-2019' ),
		},
	},
	supports: {
		inserter: false,
		reusable: false,
		html: false,
	},
	edit: props => {
		const { className, setAttributes, attributes } = props;
		const { title } = attributes;

		return (
			<div className={ className }>
				<div className="wp-block-in-2019-what-enter__wrapper">
					<RichText
						tagName="h2"
						className="wp-block-in-2019-what-enter__title"
						value={ title }
						onChange={ value => setAttributes( { title: value } ) }
						placeholder={ __( 'Title', 'in-2019' ) }
					/>
					<InnerBlocks templateLock={ false } />
				</div>
			</div>
		);
	},
	save: ( { attributes } ) => {
		const { title, id } = attributes;
		return (
			<div id={ `wp-block-in-2019-what-enter-${ id }` } className={ `wp-block-in-2019-what-enter-item-${ id } item-anchor` }>
				<div className="wp-block-in-2019-what-enter__wrapper">
					<RichText.Content tagName="h2" className="wp-block-in-2019-what-enter__title" value={ title } />
					<InnerBlocks.Content />
				</div>
			</div>
		);
	},
} );
