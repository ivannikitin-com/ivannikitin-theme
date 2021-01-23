import icon from '-!svg-react-loader!../assets/container.svg';
import classnames from 'classnames';

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
	},
	edit: function( props ) {
		const { className, attributes, setAttributes } = props;
		const { container } = attributes;

		const classes = classnames( className, container );

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
							onChange={ container => {
								setAttributes( { container } );
							} }
						/>
					</PanelBody>
				</InspectorControls>
				<div className={ classes }>
					<InnerBlocks />
				</div>
			</Fragment>
		);
	},
	save: function( props ) {
		const { attributes, className } = props;
		const { container } = attributes;

		const classes = classnames( className, container );
		return (
			<div className={ classes }>
				<InnerBlocks.Content />
			</div>
		);
	},
} );
