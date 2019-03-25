import times from 'lodash/times';

const { Component, Fragment } = wp.element;
const { RichText, InnerBlocks } = wp.editor;

class SaveCarouselIn extends Component {
	render() {
		const { attributes } = this.props;
		const { items, slides } = attributes;

		const renderSlide = index => {
			return (
				<Fragment>
					<div className={ `item items-${ index + 1 }` }>
						<RichText.Content className="item__title" tagName="h3" value={ slides[ index ].title } />
						<RichText.Content tagName="div" className="item__description" value={ slides[ index ].description } />
						<RichText.Content tagName="ul" multiline="li" value={ slides[ index ].values } />
						<RichText.Content tagName="div" className="item__price" value={ slides[ index ].price } />
						<RichText.Content
							tagName="a"
							href={ `#wp-block-in-2019-what-enter-${ index + 1 }` }
							className="item__link-more"
							value={ slides[ index ].linkMore }
						/>
						<div className="text-center">
							<RichText.Content tagName="a" className="item__order" value={ slides[ index ].order } />
						</div>
					</div>
				</Fragment>
			);
		};

		return (
			<Fragment>
				<div className="owl-carousel owl-carousel-custom">{ times( items, n => renderSlide( n ) ) }</div>
				<InnerBlocks.Content />
			</Fragment>
		);
	}
}

export default SaveCarouselIn;
