import times from 'lodash/times';

const { Component, Fragment } = wp.element;
const { RichText } = wp.editor;

class SaveCarouselIn extends Component {
	render() {
		const { attributes } = this.props;
		const { nav, items, slides } = attributes;

		const renderSlide = index => {
			return (
				<Fragment>
					<div className={ `item items-${ index }` } key={ index }>
						<RichText.Content className="item__title" tagName="h3" value={ slides[ index ].title } />
						<RichText.Content tagName="div" className="item__description" value={ slides[ index ].description } />
						<RichText.Content tagName="ul" multiline="li" value={ slides[ index ].values } />
						<RichText.Content tagName="div" className="item__price" value={ slides[ index ].price } />
						<a href="#"> Подробне о тарифе </a>
						<a href="#"> Заказать </a>
					</div>
				</Fragment>
			);
		};

		return <div className="owl-carousel owl-carousel-custom">{ times( items, n => renderSlide( n ) ) }</div>;
	}
}

export default SaveCarouselIn;
