const { InnerBlocks } = wp.editor;
const { Fragment } = wp.element;
const { Component } = wp.element;

const intabUniqueIDs = [];

class Tab extends Component {
	render() {
		const {
			attributes: { id, uniqueID },
		} = this.props;
		return (
			<Fragment>
				<div className={ `in-tab-inner-content in-inner-tab-${ id } in-inner-tab-${ uniqueID }` }>
					<InnerBlocks templateLock={ false } />
				</div>
			</Fragment>
		);
	}
}

export default Tab;
