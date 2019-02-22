import propTypes from 'prop-types';

const ArrowBlock = ( { color, id } ) => {
	return (
		<style dangerouslySetInnerHTML={ {
			__html: [
				`#${ id }.arrow-right:after {`,
				'  content: "";',
				'  position: absolute;',
				'  right: -28px;',
				'  top: 50%;',
				'  margin-top: -14px;',
				'  border: 14px solid transparent;',
				`  border-left: 14px solid ${ color };`,
				'  z-index: 3;',
				'}',
				`#${ id }.arrow-left:after {`,
				'  content: "";',
				'  position: absolute;',
				'  left: -28px;',
				'  top: 50%;',
				'  margin-top: -14px;',
				'  border: 14px solid transparent;',
				`  border-right: 14px solid ${ color };`,
				'  z-index: 3;',
				'}',
			].join( '\n' ),
		} }>
		</style>
	);
};

ArrowBlock.propTypes = {
	color: propTypes.string,
	id: propTypes.number,
};

ArrowBlock.defaultProps = {
	color: '#0c68a5',
	id: null,
};

export default ArrowBlock;
