import './style.scss';
import './editor.scss';
import icon from '-!svg-react-loader!../assets/container.svg';
import classnames from 'classnames';
import BlockName from '../components/BlockName.jsx';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { Fragment } = wp.element;
const { InspectorControls, InnerBlocks } = wp.editor;
const { PanelBody, SelectControl } = wp.components;

registerBlockType( 'in-2019/container', {
	title: __( 'Container', 'in-2019' ),
	category: 'nikitin',
	icon: icon,
	attributes: {
		container: {
			type: 'string',
			default: 'container',
		},
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
		const { className, attributes, setAttributes, name } = props;
		const { container } = attributes;

		const classes = classnames(
			className,
			container
		);

		return (
			<Fragment>
				<InspectorControls>
					<PanelBody title={ __( 'Settings', 'in-2019' ) }>
						<SelectControl
							label={ __( 'Size', 'in-2019' ) }
							value={ container }
							options={ [
								{ label: 'Container', value: 'container' },
								{ label: 'Container-fluid', value: 'container-fluid' },
							] }
							onChange={ ( container ) => {
								setAttributes( { container } );
							} }
						/>
					</PanelBody>
				</InspectorControls>
				<div className={ classes }>
					<BlockName name={ name } />
					<InnerBlocks />
				</div>
			</Fragment>
		);
	},
	save: function( props ) {
		const { attributes, className } = props;
		const { container } = attributes;

		const classes = classnames(
			className,
			container
		);
		return (
			<div className={ classes }><InnerBlocks.Content /></div>
		);
	},
} );
