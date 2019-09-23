import classnames from 'classnames';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { Button, PanelBody, TextControl } = wp.components;
const { RichText, MediaUpload, MediaUploadCheck, InspectorControls } = wp.editor;

const ALLOWED_MEDIA_TYPES = [ 'image' ];

registerBlockType( 'in-2019/advantages', {
	title: __( 'Advantage', 'in-2019' ),
	category: 'nikitin',
	attributes: {
		align: {
			type: 'string',
			default: 'wide',
		},
		count: {
			type: 'string',
		},
		countAdvanced: {
			type: 'string',
		},
		text: {
			type: 'string',
		},
		url: {
			type: 'string',
		},
		alt: {
			type: 'string',
		},
		mediaId: {
			type: 'string',
		},
	},
	supports: {
		anchor: true,
		align: [ 'wide' ],
	},
	edit: props => {
		const { className, attributes, setAttributes } = props;
		const { count, countAdvanced, text, url, alt, mediaId } = attributes;

		const mediaSelected = media => {
			setAttributes( {
				url: media.url,
				alt: media.alt,
				mediaId: media.id,
			} );
		};

		const inspectorControls = (
			<InspectorControls>
				<PanelBody>
					<TextControl
						label={ __( 'Signature', 'in-2019' ) }
						value={ countAdvanced }
						onChange={ value => setAttributes( { countAdvanced: value } ) }
					/>
				</PanelBody>
			</InspectorControls>
		);

		const classes = classnames( className, 'text-center' );
		return (
			<div className={ classes }>
				{ inspectorControls }
				<div className="wp-block-in-2019-advantages__image">
					<img src={ url } alt={ alt } />
				</div>
				<MediaUploadCheck>
					<MediaUpload
						onSelect={ mediaSelected }
						allowedTypes={ ALLOWED_MEDIA_TYPES }
						value={ mediaId }
						render={ ( { open } ) => <Button onClick={ open }>{ __( 'Open Media Library' ) }</Button> }
					/>
				</MediaUploadCheck>
				<div className="wp-block-in-2019-advantages__block">
					<RichText
						tagName="span"
						className="wp-block-in-2019-advantages__count"
						value={ count }
						onChange={ value => setAttributes( { count: value } ) }
						placeholder={ __( 'Count', 'in-2019' ) }
					/>
					{ countAdvanced && <span className="wp-block-in-2019-advantages__count-advanced">{ countAdvanced }</span> }
				</div>
				<RichText
					tagName="div"
					className="wp-block-in-2019-advantages__text"
					value={ text }
					onChange={ value => setAttributes( { text: value } ) }
					placeholder={ __( 'Text', 'in-2019' ) }
				/>
			</div>
		);
	},
	save: props => {
		const { attributes } = props;
		const { count, countAdvanced, text, url, alt } = attributes;

		const classes = classnames( 'text-center' );

		return (
			<div className={ classes }>
				<div className="wp-block-in-2019-advantages__image">
					<img src={ url } alt={ alt } />
				</div>
				<div className="wp-block-in-2019-advantages__block">
					<RichText.Content tagName="span" className="wp-block-in-2019-advantages__count" value={ count } />
					{ countAdvanced && <span className="wp-block-in-2019-advantages__count-advanced">{ countAdvanced }</span> }
				</div>
				<RichText.Content tagName="div" className="wp-block-in-2019-advantages__text" value={ text } />
			</div>
		);
	},
} );
