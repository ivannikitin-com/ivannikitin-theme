import className from 'classnames';
import propTypes from 'prop-types';

const { getBlockType } = wp.blocks;

const BlockName = ( { name } ) => {
	const classes = className(
		'name'
	);

	const blockType = getBlockType( name );

	return (
		<span className={ classes }>{ blockType.title }</span>
	);
};

BlockName.propTypes = {
	name: propTypes.string,
};

BlockName.defaultProps = {
	name: '',
};

export default BlockName;
