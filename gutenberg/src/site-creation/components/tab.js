import React, { Component } from 'react';
import PropTypes from 'prop-types';
import classnames from 'classnames';

class Tab extends Component {
	static propTypes = {
		activeTab: PropTypes.string.isRequired,
		label: PropTypes.string.isRequired,
		onClick: PropTypes.func.isRequired,
	};

	render() {
		const {
			onClick,
			props: { activeTab, label },
		} = this;

		const classes = classnames( 'tab-list-item', {
			'tab-list-active': activeTab === label,
		} );

		return (
			<li className={ classes } onClick={ onClick }>
				{ label }
			</li>
		);
	}
}

export default Tab;
