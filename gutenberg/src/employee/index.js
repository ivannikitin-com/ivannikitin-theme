import './style.scss';
import './editor.scss';
import icon from '-!svg-react-loader!../assets/employee.svg';
import edit from './edit';
import Image from '../components/Image.jsx';
import classnames from 'classnames';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;

registerBlockType( 'in-2019/employee', {
	title: __( 'Employee', 'in-2019' ),
	category: 'nikitin',
	icon: icon,
	attributes: {
		widthImage: {
			type: 'number',
			default: 195,
		},
		heighthImage: {
			type: 'number',
			default: 195,
		},
		circleImage: {
			type: 'boolean',
			default: true,
		},
		currentPostType: {
			type: 'string',
			default: '',
		},
		currentPost: {
			type: 'string',
			default: '',
		},
		name: {
			type: 'string',
		},
		src: {
			type: 'string',
		},
		alt: {
			typr: 'string',
		},
		alignment: {
			type: 'string',
		},
	},
	edit,
	save: function( props ) {
		const { attributes } = props;
		const { name, src, alt, widthImage, heighthImage, circleImage, alignment } = attributes;

		const classes = classnames(
			`text-${ alignment }`
		);
		return (
			<div className={ classes }>
				<Image
					width={ widthImage }
					height={ heighthImage }
					circle={ circleImage }
					src={ src }
					alt={ alt }
				/>
				<div className="employee_name">{ name }</div>
				<div className="employee_rank"></div>
			</div>
		);
	},
} );
