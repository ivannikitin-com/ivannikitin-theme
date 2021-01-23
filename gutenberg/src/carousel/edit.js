import times from 'lodash/times';
import memoize from 'lodash/memoize';
import './components/descriptionCarouselBlock';
import './components/whatEnter';

const { __ } = wp.i18n;
const { Component, Fragment } = wp.element;
const { InspectorControls, RichText, InnerBlocks } = wp.editor;
const { PanelBody, RangeControl, ToggleControl } = wp.components;

const ALLOWED_BLOCKS = [ 'in-2019/carousel-description', 'in-2019/what-enter' ];

const getPanesTemplate = memoize( ( panels, slides ) => {
	return times( panels, n => [
		'in-2019/what-enter',
		{
			id: n + 1,
		},
		[
			[
				'in-2019/col',
				{
					md: 12,
				},
				[
					[
						'in-2019/row',
						{},
						[
							[
								'in-2019/col',
								{
									md: 3,
								},
							],
							[
								'in-2019/col',
								{
									md: 3,
								},
							],
							[
								'in-2019/col',
								{
									md: 3,
								},
							],
							[
								'in-2019/col',
								{
									md: 3,
								},
							],
						],
					],
				],
			],
			[
				'in-2019/carousel-description',
				{
					id: n + 1,
					title: slides[ n ].title,
					price: slides[ n ].price,
				},
			],
		],
	] );
} );

class CarouselIn extends Component {
	saveArrayUpdate( value, index ) {
		const { attributes, setAttributes } = this.props;
		const { slides } = attributes;

		const newItems = slides.map( ( item, thisIndex ) => {
			if ( index === thisIndex ) {
				item = {
					...item,
					...value,
				};
			}

			return item;
		} );
		setAttributes( {
			slides: newItems,
		} );
	}

	render() {
		const { className, setAttributes, attributes } = this.props;
		const { items, slides, currentSlide } = attributes;

		const settingsCarousel = (
			<Fragment>
				<PanelBody>
					<RangeControl
						label={ __( 'Tabs', 'in-2019' ) }
						value={ items }
						onChange={ nextSlides => {
							const newSlides = slides;
							if ( newSlides.length < nextSlides ) {
								const amount = Math.abs( nextSlides - newSlides.length );
								{
									times( amount, n => {
										newSlides.push( {
											title: __( 'Title', 'in-2019' ),
											description: __( 'Description', 'in-2019' ),
											text_gift: __( 'gift for order', 'in-2019' ),
											gift: true,
											values: __( '<li>Point</li>', 'in-2019' ),
											price: '1 000 ₽',
											linkMore: __( 'More about the tariff', 'in-2019' ),
											order: __( 'Order', 'in-2019' ),
										} );
									} );
								}
								setAttributes( {
									slides: newSlides,
								} );
							}
							setAttributes( {
								items: nextSlides,
							} );
						} }
						min={ 1 }
						max={ 5 }
					/>
				</PanelBody>
				<PanelBody label={ `Settings slide ${ slides[ currentSlide ].title }` }>
					<ToggleControl
						label={ __( 'Gift', 'in-2019' ) }
						checked={ slides[ currentSlide ].gift }
						onChange={ value => this.saveArrayUpdate( { gift: value }, currentSlide ) }
					/>
				</PanelBody>
			</Fragment>
		);

		const renderSlide = index => {
			return (
				<Fragment>
					<div className={ `item items-${ index }` } onClick={ () => setAttributes( { currentSlide: index } ) }>
						<div className="item-title-wrapper">
							<RichText
								className="item__title"
								tagName="h3"
								placeholder={ __( 'Title', 'in-2019' ) }
								value={ slides[ index ].title }
								onChange={ value => {
									this.saveArrayUpdate(
										{
											title: value,
										},
										index
									);
								} }
							/>
							{ slides[ index ].gift && (
								<div className="item__gift">
									подарок
									при заказе
								</div>
							) }
						</div>
						<RichText
							tagName="div"
							className="item__description"
							placeholder={ __( 'Description', 'in-2019' ) }
							value={ slides[ index ].description }
							onChange={ value => {
								this.saveArrayUpdate(
									{
										description: value,
									},
									index
								);
							} }
						/>
						<RichText
							tagName="ul"
							multiline="li"
							value={ slides[ index ].values }
							onChange={ value => {
								this.saveArrayUpdate( { values: value }, index );
							} }
							placeholder={ __( 'Point', 'in-2019' ) }
						/>
						<RichText
							tagName="div"
							className="item__price"
							placeholder={ __( 'Price', 'in-2019' ) }
							value={ slides[ index ].price }
							onChange={ value => {
								this.saveArrayUpdate( { price: value }, index );
							} }
						/>
						<RichText
							tagName="a"
							cclassName="item__link-more"
							value={ slides[ index ].linkMore }
							onChange={ value => {
								this.saveArrayUpdate( { linkMore: value }, index );
							} }
						/>
						<div className="text-center">
							<RichText
								tagName="a"
								className="item__order"
								value={ slides[ index ].order }
								onChange={ value => {
									this.saveArrayUpdate( { order: value }, index );
								} }
							/>
						</div>
					</div>
				</Fragment>
			);
		};

		const renderPreviewArray = <Fragment> { times( items, n => renderSlide( n ) ) } </Fragment>;

		return (
			<Fragment>
				<div className={ className }>
					<InspectorControls>{ settingsCarousel }</InspectorControls>
					{ renderPreviewArray }
					<InnerBlocks template={ getPanesTemplate( items, slides ) } templateLock="all" allowedBlocks={ ALLOWED_BLOCKS } />
				</div>
			</Fragment>
		);
	}
}

export default CarouselIn;
