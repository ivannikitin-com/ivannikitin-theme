import './style.scss';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { InnerBlocks, RichText } = wp.editor;

registerBlockType( 'in-2019/carousel-description', {
	title: __( 'Carousel description', 'in-2019' ),
	category: 'nikitin',
	parents: [ 'in-2019/carousel' ],
	attributes: {
		id: {
			type: 'number',
			default: 0,
		},
		title: {
			type: 'string',
			default: __( 'Title', 'in-2019' ),
		},
		price: {
			type: 'string',
			default: '1 000 ₽',
		},
		text: {
			type: 'string',
			default: '',
		},
		linkExample: {
			type: 'string',
			default: __( 'Look example', 'in-2019' ),
		},
		order: {
			type: 'string',
			default: __( 'Order now', 'in-2019' ),
		},
	},
	getEditWrapperProps( attributes ) {
		return { 'data-tab': attributes.id };
	},
	supports: {
		inserter: false,
		reusable: false,
		html: false,
	},
	edit: props => {
		const { className, attributes, setAttributes } = props;
		const { title, price, linkExample, order } = attributes;

		return (
			<div className={ className }>
				<div className="carousel-description-wrapper">
					<div className="carousel-description-item">
						<RichText
							tagName="h3"
							className="carousel-description-title"
							value={ title }
							palaceholder={ __( 'Title', 'in-2019' ) }
							onChange={ value => setAttributes( { title: value } ) }
						/>
						<InnerBlocks templateLock={ false } />
					</div>
					<div className="carousel-description-item">
						<RichText
							tagName="div"
							className="carousel-description-price"
							value={ price }
							palaceholder={ __( 'Price', 'in-2019' ) }
							onChange={ value => setAttributes( { price: value } ) }
						/>
						<RichText
							tagName="div"
							className="carousel-description-link"
							value={ linkExample }
							palaceholder={ __( 'Link example', 'in-2019' ) }
							onChange={ value => setAttributes( { linkExample: value } ) }
						/>
						<RichText
							tagName="div"
							className="carousel-description-button"
							value={ order }
							palaceholder={ __( 'Price', 'in-2019' ) }
							onChange={ value => setAttributes( { order: value } ) }
						/>
					</div>
				</div>
			</div>
		);
	},
	save: ( { attributes } ) => {
		const { id, title, price, linkExample, order } = attributes;
		return (
			<div className={ `carousel-description-number-${ id }` }>
				<div className="carousel-description-wrapper">
					<div className="carousel-description-item">
						<RichText.Content tagName="h3" className="carousel-description-title" value={ title } />
						<InnerBlocks.Content />
					</div>
					<div className="carousel-description-item">
						<RichText.Content tagName="div" className="carousel-description-price" value={ price } />
						<RichText.Content tagName="div" className="carousel-description-link" value={ linkExample } />
						<RichText.Content tagName="div" data-fancybox="" data-src="#order_service" className="carousel-description-button" data-name-service={ title } value={ order } />
					</div>
				</div>
			</div>
		);
	},
} );
