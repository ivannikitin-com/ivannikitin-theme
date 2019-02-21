import className from 'classnames';
import propTypes from 'prop-types';

const { getBlockType } = wp.blocks;

const BlockName = ( { name, text } ) => {
	const classes = className(
		'block-name-top'
	);

	const blockType = getBlockType( name );

	return (
		<span className={ classes } style={ nameStyle }>{ blockType.title } { text }</span>
	);
};

BlockName.propTypes = {
	name: propTypes.string,
	text: propTypes.string,
};

BlockName.defaultProps = {
	name: '',
	text: '',
};

export default BlockName;

const nameStyle = {
	position: 'absolute',
	height: '30px',
	padding: '5px',
	top: 0,
	left: 0,
	fontSize: '14px',
	width: '100%',
	textAlign: 'right',
	background: '#d0cdcd',
	whiteSpace: 'nowrap',
	overflow: 'hidden',
	textOverflow: 'ellipsis',
};
