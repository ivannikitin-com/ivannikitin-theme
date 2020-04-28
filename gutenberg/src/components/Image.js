import PropTypes from 'prop-types';
import classnames from 'classnames';

const Image = ( {
	src, alt, className, width, height, circle, ...attrs
} ) => {
	if ( ! src ) {
		src = `https://imgplaceholder.com/${ width }x${ height }/cccccc/757575/glyphicon-user`;
	}

	const classes = classnames(
		className,
		{
			'rounded-circle': circle,
		}
	);

	return (
		<img
			src={ src }
			alt={ alt }
			className={ classes }
			width={ width }
			height={ height }
			{ ...attrs }
		/>
	);
};

Image.propTypes = {
	src: PropTypes.string,
	alt: PropTypes.string,
	className: PropTypes.string,
	width: PropTypes.number,
	height: PropTypes.number,
	circle: PropTypes.boolean,
};

Image.defaultProps = {
	src: '',
	alt: 'image',
	className: '',
	width: 100,
	height: 100,
	circle: false,
};

export default Image;
