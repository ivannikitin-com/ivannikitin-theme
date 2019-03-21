import classnames from 'classnames';
import times from 'lodash/times';

const { Component, Fragment } = wp.element;
const { InnerBlocks, RichText } = wp.editor;

class TabsSave extends Component {
	render() {
		const {
			attributes: { tabCount, currentTab, uniqueID, titles },
		} = this.props;

		const classes = classnames(
			`in-tabs-wrap in-tabs-id${ uniqueID } in-tabs-has-${ tabCount }-tabs in-active-tab-${ currentTab }`
		);

		const renderTitles = index => {
			return (
				<Fragment>
					<li
						className={ `in-title-item in-title-item-${ index } in-tab-title-${
							1 + index === currentTab ? 'active' : 'inactive'
						}` }
					>
						<a href="javascript:;" data-tab={ 1 + index } className={ `in-tab-title in-tab-title-${ 1 + index } ` }>
							<div className="in-tab-title-image">
								<img src={ titles[ index ].url } alt={ titles[ index ].alt } />
							</div>
							<RichText.Content tagName="span" value={ titles[ index ].text } className={ 'in-title-text' } />
						</a>
					</li>
				</Fragment>
			);
		};

		return (
			<div className={ classes }>
				<ul className="in-tabs-title-list">{ times( tabCount, n => renderTitles( n ) ) }</ul>
				<div className="in-tabs-content-wrap">
					<InnerBlocks.Content />
				</div>
			</div>
		);
	}
}

export default TabsSave;
