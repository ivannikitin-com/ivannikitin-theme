import './editor.scss';
import icon from '-!svg-react-loader!../assets/row.svg';
import classnames from 'classnames';
import BlockName from '../components/BlockName.jsx';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { InnerBlocks } = wp.editor;

registerBlockType( 'in-2019/row', {
	title: __( 'Row', 'in-2019' ),
	category: 'nikitin',
	icon: icon,
	attributes: {
		align: {
			type: 'string',
			default: 'wide',
		},
	},
	supports: {
		align: [ 'wide' ],
		anchor: true,
	},
	edit: function( props ) {
		const { className, name } = props;

		const classes = classnames(
			className
		);

		return (
			<div className={ classes }>
				<BlockName name={ name } />
				<InnerBlocks />
			</div>
		);
	},
	save: function( props ) {
		const { className } = props;

		const classes = classnames(
			className,
			'row'
		);

		return (
			<div className={ classes }><InnerBlocks.Content /></div>
		);
	},
} );
