const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { Fragment } = wp.element;
const { RichText } = wp.editor;

registerBlockType( 'in-2019/slide', {
	title: __( 'Slide', 'in-2019' ),
	category: 'nikitin',
	parent: [ 'in-2019/carousel' ],
	attributes: {
		index: {
			type: 'number',
			defualt: 1,
		},
		title: {
			type: 'string',
			default: __( 'Title', 'in-2019' ),
		},
		description: {
			type: 'string',
			default: __( 'Description', 'in-2019' ),
		},
		text_gift: {
			type: 'string',
			default: __( 'gift for order', 'in-2019' ),
		},
		gift: {
			type: 'boolean',
			default: true,
		},
		values: {
			type: 'string',
			source: 'html',
			selector: 'ul',
			multiline: 'li',
			default: '<li>Point</li>',
		},
		price: {
			type: 'string',
			default: '1 000 ₽',
		},
	},
	supports: {
		inserter: false,
		reusable: false,
		html: false,
	},
	edit: props => {
		const { className, attributes, setAttributes } = props;
		const { index, title, description, text_gift, gift, values, price } = attributes;
		return (
			<Fragment>
				<div className={ className }>
					<div className={ `item items-${ index }` } key={ index }>
						<RichText
							className="item__title"
							tagName="h3"
							placeholder={ __( 'Title', 'in-2019' ) }
							value={ title }
							onChange={ value => setAttributes( { title: value } ) }
						/>
						<RichText
							tagName="div"
							className="item__description"
							placeholder={ __( 'Description', 'in-2019' ) }
							value={ description }
							onChange={ value => setAttributes( { description: value } ) }
						/>
						<RichText
							tagName="ul"
							multiline="li"
							value={ values }
							onChange={ value => setAttributes( { values: value } ) }
							placeholder={ __( 'Point', 'in-2019' ) }
						/>
						<RichText
							tagName="div"
							className="item__price"
							placeholder={ __( 'Price', 'in-2019' ) }
							value={ price }
							onChange={ value => setAttributes( { price: value } ) }
						/>
						<a href="#">Подробне о тарифе</a>
						<a href="#">Заказать</a>
					</div>
				</div>
			</Fragment>
		);
	},
	save: props => {
		return null;
	},
} );
