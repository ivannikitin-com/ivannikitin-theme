import classnames from 'classnames';
const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { Fragment } = wp.element;
const { RichText, InspectorControls } = wp.editor;
const { PanelBody, ToggleControl } = wp.components;

registerBlockType( 'in-2019/item-list', {
	title: __( 'Item List', 'in-2019' ),
	category: 'nikitin',
	attributes: {
		text: {
			type: 'string',
		},
		error: {
			type: 'boolean',
			default: false,
		},
	},
	parent: [ 'in-2019/list' ],
	supports: {
		reusable: false,
		html: false,
	},
	edit: props => {
		const { className, attributes, setAttributes } = props;
		const { error, text } = attributes;

		const classes = classnames( className, {
			'wp-block-in-2019-item-list-error': error,
			'wp-block-in-2019-item-list-succeses': ! error,
		} );

		const settingsBlock = (
			<PanelBody label={ __( 'Settings' ) }>
				<ToggleControl
					label={ __( 'Error', 'in-2019' ) }
					checked={ error }
					onChange={ value => setAttributes( { error: value } ) }
				/>
			</PanelBody>
		);
		return (
			<Fragment>
				<InspectorControls>{ settingsBlock }</InspectorControls>
				<RichText
					tagName="div"
					className={ classes }
					value={ text }
					onChange={ value => setAttributes( { text: value } ) }
					placeholder={ __( 'Text', 'in-2019' ) }
				/>
			</Fragment>
		);
	},
	save: ( { attributes } ) => {
		const { text, error } = attributes;

		const classes = classnames( {
			'wp-block-in-2019-item-list-error': error,
			'wp-block-in-2019-item-list-succeses': ! error,
		} );

		return <RichText.Content tagName="div" className={ classes } value={ text } />;
	},
} );
