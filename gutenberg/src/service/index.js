import './style.scss';
import './editor.scss';
import icon from '-!svg-react-loader!../assets/service.svg';
import classname from 'classnames';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { InnerBlocks, InspectorControls } = wp.editor;
const { Fragment } = wp.element;
const { ToggleControl, PanelBody } = wp.components;

registerBlockType( 'in-2019/service', {
	title: __( 'Service', 'in-2019' ),
	icon: icon,
	category: 'nikitin',
	attributes: {
		center: {
			type: 'boolean',
		},
	},
	supports: {
		anchor: true,
	},
	edit: function( props ) {
		const { className, attributes, setAttributes } = props;
		const { center } = attributes;

		const inspectorControl = (
			<InspectorControls>
				<PanelBody title={ __( 'Settings', 'in-2019' ) } initialOpen={ true } >
					<ToggleControl
						label={ __( 'Center', 'in-2019' ) }
						checked={ center }
						onChange={ center => {
							setAttributes( { center } );
						} }
					/>
				</PanelBody>
			</InspectorControls>
		);

		const classes = classname(
			className,
			{
				'align-middle': center,
			}
		);

		return (
			<Fragment>
				{ inspectorControl }
				<div className={ classes }>
					<InnerBlocks />
				</div>
			</Fragment>
		);
	},
	save: function( props ) {
		const { attributes } = props;
		const { center } = attributes;

		const classes = classname(
			{
				'align-middle': center,
			}
		);

		return (
			<div className={ classes }>
				<InnerBlocks.Content />
			</div>
		);
	},
} )
;
