import './editor.scss';
import './style.scss';
import icon from '-!svg-react-loader!../assets/section.svg';
import classnames from 'classnames';

const { __ } = wp.i18n;
const { Fragment } = wp.element;
const { registerBlockType } = wp.blocks;
const { InnerBlocks, MediaUpload, MediaUploadCheck, BlockControls, InspectorControls, PanelColorSettings, withColors } = wp.editor;
const { Toolbar, IconButton, ToggleControl, PanelBody, RangeControl, withNotices } = wp.components;
const { compose } = wp.compose;

const ALLOWED_MEDIA_TYPES = [ 'image', 'video' ];
const IMAGE_BACKGROUND_TYPE = 'image';
const VIDEO_BACKGROUND_TYPE = 'video';

registerBlockType('in-2019/section', {
	title: __( 'Section', 'in-2019' ),
	category: 'nikitin',
	icon: icon,
	keywords: [
		__( 'Section', 'in-2019' ),
	],
	attributes: {
		url: {
			type: 'string',
		},
		id: {
			type: 'number',
		},
		backgroundType: {
			type: 'string',
			default: 'image',
		},
		hasParallax: {
			type: 'boolean',
			default: false,
		},
		hasRepeat: {
			type: 'boolean',
			default: false,
		},
		hasCover: {
			type: 'boolean',
			default: false,
		},
		overlayColor: {
			type: 'string',
		},
		opacity: {
			type: 'number',
			default: 50
		},
		align: {
			type: 'string',
			default: 'full',
		},
	},
	supports: {
		align: [ 'full' ],
		anchor: true,
	},
	edit: compose( [
		withColors( { overlayColor: 'background-color' } ),
		withNotices,
	] )(
		( { className, attributes, setAttributes, overlayColor, setOverlayColor } ) => {
			const { url, id, hasParallax, hasRepeat, hasCover, backgroundType, opacity } = attributes;

			const toggleParallax = () => setAttributes( { hasParallax: ! hasParallax } );
			const toggleRepeat = () => setAttributes( { hasRepeat: ! hasRepeat } );
			const toggleCover = () => setAttributes( { hasCover: ! hasCover } );
			const setOpacity = ( opacityNew ) => setAttributes( { opacity: opacityNew } );

			const removeBackground = () => {
				setAttributes( { url: undefined, id: undefined } );
			};
			const onSelectMedia = ( media ) => {
				if ( ! media || ! media.url  ) {
					setAttributes( { url: undefined, id: undefined } );
					return;
				}
				let mediaType;
				if ( media.media_type ) {
					if ( media.media_type === IMAGE_BACKGROUND_TYPE ) {
						mediaType = IMAGE_BACKGROUND_TYPE;
					} else {
						mediaType = VIDEO_BACKGROUND_TYPE;
					}
				} else {
					if (
						media.type !== IMAGE_BACKGROUND_TYPE &&
						media.type !== VIDEO_BACKGROUND_TYPE
					) {
						return;
					}
					mediaType = media.type;
				}
	
				setAttributes( {
					url: media.url,
					id: media.id,
					backgroundType: mediaType,
				} );
			}
	
			const style = {
				...(
					backgroundType === IMAGE_BACKGROUND_TYPE ?
						backgroundImageStyles( url ) :
						{}
				),
				backgroundColor: overlayColor.color,
			};

			const classes = classnames(
				className,
				opacityToClass( opacity ),
				{
					'has-background-opacity': opacity !== 0,
					'has-parallax': hasParallax,
					'no-repeat': hasRepeat,
					'cover': hasCover,
				}
			);
			return (
				<Fragment>
					<BlockControls>
						<Fragment>
							<MediaUploadCheck>
								<Toolbar>	
									<MediaUpload
										onSelect={ onSelectMedia }
										value={ id }
										allowedTypes={ ALLOWED_MEDIA_TYPES }
										render={ ( { open } ) => (
											<IconButton
												className="components-toolbar__control"
												icon="edit"
												label={ __( 'Edit background', 'in-2019' ) }
												onClick={ open }
											/>
										) }
									/>
									<IconButton
										className="components-toolbar__control"
										icon="no"
										label={ __( 'Reset background image', 'in-2019' ) }
										onClick={ removeBackground }
									/>
								</Toolbar>
							</MediaUploadCheck>
						</Fragment>
					</BlockControls>
					<InspectorControls>
						<PanelBody title={ __( 'Background Settings', 'in-2019' ) }>
							{ !! url && IMAGE_BACKGROUND_TYPE === backgroundType && (
								<Fragment>
									<ToggleControl
										label={ __( 'Fixed', 'in-2019' ) }
										checked={ hasParallax }
										onChange={ toggleParallax }
									/>
									<ToggleControl
										label={ __( 'Cover', 'in-2019' ) }
										checked={ hasCover }
										onChange={ toggleCover }
									/>
									<ToggleControl
										label={ __( 'No Repeat', 'in-2019' ) }
										checked={ hasRepeat }
										onChange={ toggleRepeat }
									/>
									<RangeControl
										label={ __( 'Background Opacity', 'in-2019' ) }
										value={ opacity }
										onChange={ setOpacity }
										min={ 0 }
										max={ 100 }
										step={ 10 }
									/>
								</Fragment>
							) }
							<PanelColorSettings
								title={ __( 'Overlay', 'in-2019' ) }
								initialOpen={ true }
								colorSettings={ [ {
									value: overlayColor.color,
									onChange: setOverlayColor,
									label: __( 'Overlay Color' ),
								} ] }
							/>
						</PanelBody>
					</InspectorControls>
					<section className={ classes } style={ style } ><InnerBlocks /></section>
				</Fragment>
			);
		}
	),
	save: function( props ) {
		return (
			<section><InnerBlocks.Content /></section>
		);
	},
});

function opacityToClass( ratio ) {
	return ( ratio === 0 || ratio === 50 ) ?
		null :
		'has-background-opacity-' + ( 10 * Math.round( ratio / 10 ) );
}

function backgroundImageStyles( url ) {
	return url ?
		{ backgroundImage: `url(${ url })` } :
		{};
}
