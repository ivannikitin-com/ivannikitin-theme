import OwlCarousel from 'react-owl-carousel2';
import times from 'lodash/times';
import Accordion from './components/Accordion';

const { __ } = wp.i18n;
const { Component, Fragment } = wp.element;
const { InspectorControls, RichText } = wp.editor;
const { PanelBody, ToggleControl, RangeControl } = wp.components;

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
		const { nav, items, slides } = attributes;

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
					<ToggleControl
						label={ __( 'Show navigate arrow', 'in-2019' ) }
						checked={ nav }
						onChange={ value =>
							setAttributes( {
								nav: value,
							} )
						}
					/>
				</PanelBody>
			</Fragment>
		);

		const renderSlide = index => {
			console.log( slides[ index ] );
			return (
				<Fragment>
					<div className={ `item items-${ index }` } key={ index }>
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
						<a href="#">Подробне о тарифе</a>
						<a href="#">Заказать</a>
					</div>
					<Accordion />
				</Fragment>
			);
		};

		const renderPreviewArray = <Fragment> { times( items, n => renderSlide( n ) ) } </Fragment>;

		return (
			<Fragment>
				<div className={ className }>
					<InspectorControls>{ settingsCarousel }</InspectorControls>
					{ renderPreviewArray }
				</div>
			</Fragment>
		);
	}
}

export default CarouselIn;
