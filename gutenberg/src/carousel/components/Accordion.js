import classnames from 'classnames';
import './editor.scss';

const { Component } = wp.element;

class AccordinIN extends Component {
	constructor() {
		super( ...arguments );
		this.state = {
			openned: false,
		};
	}

	render() {
		const { openned } = this.state;
		const classes = classnames( 'in-accordion-item', {
			'in-accordion-item--openned': openned,
		} );
		return (
			<div className="in-accordion-wrapper">
				<ul className="in-accordion-list">
					<li className={ classes } onClick={ () => this.setState( { openned: ! openned } ) }>
						<div className="in-accordion-item__title">
							<span>Дополнительная информация по слайду</span>
							<div className="in-accordion-item__icon" />
						</div>
						<div className="in-accordion-item__inner">
							<div className="in-accordion-item__content">
								Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolore officiis culpa, facilis atque ratione
								nesciunt quod ab adipisci repellendus, quas laborum dolor tempora nobis ipsa magnam consectetur illo
								beatae. Unde!
							</div>
						</div>
					</li>
				</ul>
			</div>
		);
	}
}

export default AccordinIN;
