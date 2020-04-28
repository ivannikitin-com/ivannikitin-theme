import icon from '-!svg-react-loader!../assets/col.svg';
import classnames from 'classnames';
import blockAttributes from './components/attributes';
import ArrowBlock from '../components/ArrowBlock';

const { __ } = wp.i18n;
const { compose, withInstanceId, createHigherOrderComponent } = wp.compose;
const { Fragment } = wp.element;
const { registerBlockType } = wp.blocks;
const {
	Toolbar,
	IconButton,
	ToggleControl,
	PanelBody,
	RangeControl,
	TextControl,
	RadioControl,
	Button,
} = wp.components;
const {
	InnerBlocks,
	MediaUpload,
	MediaUploadCheck,
	BlockControls,
	InspectorControls,
	PanelColorSettings,
	withColors,
	getColorClassName,
} = wp.editor;

const ALLOWED_MEDIA_TYPES = [ 'image' ];
const IMAGE_BACKGROUND_TYPE = 'image';

registerBlockType( 'in-2019/col', {
	title: __( 'Col', 'in-2019' ),
	category: 'nikitin',
	icon: icon,
	attributes: blockAttributes,
	edit: compose( [ withColors( { overlayColor: 'background-color' } ) ] )(
		withInstanceId( props => {
			const { className, attributes, setAttributes, overlayColor, setOverlayColor, instanceId } = props;
			const {
				xl,
				lg,
				md,
				sm,
				xs,
				orderXl,
				orderLg,
				orderMd,
				orderSm,
				orderXs,
				order,
				offsetXl,
				offsetLg,
				offsetMd,
				offsetSm,
				offsetXs,
				url,
				id,
				hasParallax,
				hasRepeat,
				hasCover,
				backgroundType,
				opacity,
				arrow,
				idBlock,
			} = attributes;

			const idCurrentBlock = getId => {
				setAttributes( { idBlock: getId } );
			};

			const toggleParallax = () => setAttributes( { hasParallax: ! hasParallax } );
			const toggleRepeat = () => setAttributes( { hasRepeat: ! hasRepeat } );
			const toggleCover = () => setAttributes( { hasCover: ! hasCover } );
			const setOpacity = opacityNew => setAttributes( { opacity: opacityNew } );

			const removeBackground = () => {
				setAttributes( { url: undefined, id: undefined } );
			};
			const onSelectMedia = media => {
				if ( ! media || ! media.url ) {
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
					if ( media.type !== IMAGE_BACKGROUND_TYPE && media.type !== VIDEO_BACKGROUND_TYPE ) {
						return;
					}
					mediaType = media.type;
				}

				setAttributes( {
					url: media.url,
					id: media.id,
					backgroundType: mediaType,
				} );
			};

			const blockControls = (
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
			);

			const panelBodyBg = (
				<PanelBody title={ __( 'Background Settings', 'in-2019' ) } initialOpen={ false }>
					{ !! url && IMAGE_BACKGROUND_TYPE === backgroundType && (
						<Fragment>
							<ToggleControl label={ __( 'Fixed', 'in-2019' ) } checked={ hasParallax } onChange={ toggleParallax } />
							<ToggleControl label={ __( 'Cover', 'in-2019' ) } checked={ hasCover } onChange={ toggleCover } />
							<ToggleControl label={ __( 'No Repeat', 'in-2019' ) } checked={ hasRepeat } onChange={ toggleRepeat } />
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
						colorSettings={ [
							{
								value: overlayColor.color,
								onChange: setOverlayColor,
								label: __( 'Overlay Color' ),
							},
						] }
					/>
				</PanelBody>
			);

			const style = {
				...( backgroundType === IMAGE_BACKGROUND_TYPE ? backgroundImageStyles( url ) : {} ),
				backgroundColor: overlayColor.color,
			};

			const classes = classnames( className, opacityToClass( opacity ), {
				'has-background-opacity': opacity !== 0 && url,
				'has-parallax': hasParallax,
				'no-repeat': hasRepeat,
				cover: hasCover,
			} );

			const orderSettings = (
				<PanelBody title={ __( 'Order', 'in-2019' ) }>
					<TextControl
						label="Order XL"
						type="number"
						value={ orderXl }
						onChange={ orderXl => setAttributes( { orderXl } ) }
					/>
					<TextControl
						label="Order LG"
						type="number"
						value={ orderLg }
						onChange={ orderLg => setAttributes( { orderLg } ) }
					/>
					<TextControl
						label="Order MD"
						type="number"
						value={ orderMd }
						onChange={ orderMd => setAttributes( { orderMd } ) }
					/>
					<TextControl
						label="Order SM"
						type="number"
						value={ orderSm }
						onChange={ orderSm => setAttributes( { orderSm } ) }
					/>
					<TextControl
						label="Order XS"
						type="number"
						value={ orderXs }
						onChange={ orderXs => setAttributes( { orderXs } ) }
					/>
					<TextControl label="Order" type="number" value={ order } onChange={ order => setAttributes( { order } ) } />
				</PanelBody>
			);

			const offset = (
				<PanelBody title={ __( 'Offset', 'in-2019' ) }>
					<TextControl
						label="Offset XL"
						type="number"
						value={ offsetXl }
						onChange={ offsetXl => {
							setAttributes( { offsetXl } );
						} }
					/>
					<TextControl
						label="Offset LG"
						type="number"
						value={ offsetLg }
						onChange={ offsetLg => setAttributes( { offsetLg } ) }
					/>
					<TextControl
						label="Offset MD"
						type="number"
						value={ offsetMd }
						onChange={ offsetMd => setAttributes( { offsetMd } ) }
					/>
					<TextControl
						label="Offset SM"
						type="number"
						value={ offsetSm }
						onChange={ offsetSm => setAttributes( { offsetSm } ) }
					/>
					<TextControl
						label="Offset XS"
						type="number"
						value={ offsetXs }
						onChange={ offsetXs => setAttributes( { offsetXs } ) }
					/>
				</PanelBody>
			);
			return (
				<Fragment>
					{ blockControls }
					<InspectorControls title={ __( 'Settings', 'in-2019' ) }>
						<PanelBody title={ __( 'Arrow', 'in-2019' ) }>
							<RadioControl
								selected={ arrow }
								options={ [ { label: 'Left', value: 'arrow-left' }, { label: 'Right', value: 'arrow-right' } ] }
								onChange={ arrow => {
									setAttributes( { arrow } );
								} }
							/>
							<Button
								isDefault
								onClick={ () => {
									setAttributes( { arrow: null } );
								} }
							>
								{ __( 'Reset', 'in-2019' ) }
							</Button>
						</PanelBody>
						<PanelBody title={ __( 'Settings', 'in-2019' ) }>
							<RangeControl
								label="Columns XL"
								value={ xl }
								onChange={ xl => {
									setAttributes( { xl } );
								} }
								min={ 0 }
								max={ 12 }
							/>
							<RangeControl label="Columns LG" value={ lg } onChange={ lg => setAttributes( { lg } ) } min={ 0 } max={ 12 } />
							<RangeControl label="Columns MD" value={ md } onChange={ md => setAttributes( { md } ) } min={ 0 } max={ 12 } />
							<RangeControl label="Columns SM" value={ sm } onChange={ sm => setAttributes( { sm } ) } min={ 0 } max={ 12 } />
							<RangeControl label="Columns XS" value={ xs } onChange={ xs => setAttributes( { xs } ) } min={ 0 } max={ 12 } />
						</PanelBody>
						{ orderSettings }
						{ offset }
						{ panelBodyBg }
						{ idCurrentBlock( instanceId ) }
					</InspectorControls>
					<div className={ classes } style={ style }>
						<InnerBlocks />
					</div>
				</Fragment>
			);
		} )
	),
	save: function( props ) {
		const { attributes } = props;
		const {
			xl,
			lg,
			md,
			sm,
			xs,
			orderXl,
			orderLg,
			orderMd,
			orderSm,
			orderXs,
			order,
			offsetXl,
			offsetLg,
			offsetMd,
			offsetSm,
			offsetXs,
			url,
			hasParallax,
			hasRepeat,
			hasCover,
			opacity,
			overlayColor,
			customOverlayColor,
			arrow,
			idBlock,
		} = attributes;

		const overlayColorClass = getColorClassName( 'background-color', overlayColor );
		const style = backgroundImageStyles( url );
		if ( ! overlayColorClass ) {
			style.backgroundColor = customOverlayColor;
		}

		const classes = classnames( overlayColorClass, !! url && opacityToClass( opacity ), `${ arrow }_${ idBlock }`, {
			'has-background-opacity': opacity !== 0 && url,
			'has-parallax': hasParallax,
			'no-repeat': hasRepeat,
			cover: hasCover,
			[ `col-xl-${ xl }` ]: xl,
			[ `col-lg-${ lg }` ]: lg,
			[ `col-md-${ md }` ]: md,
			[ `col-sm-${ sm }` ]: sm,
			[ `col-xs-${ xs }` ]: xs,
			[ `order-${ order }` ]: order,
			[ `order-xl-${ orderXl }` ]: orderXl,
			[ `order-lg-${ orderLg }` ]: orderLg,
			[ `order-md-${ orderMd }` ]: orderMd,
			[ `order-sm-${ orderSm }` ]: orderSm,
			[ `order-xs-${ orderXs }` ]: orderXs,
			[ `offset-xl-${ offsetXl }` ]: offsetXl,
			[ `offset-lg-${ offsetLg }` ]: offsetLg,
			[ `offset-md-${ offsetMd }` ]: offsetMd,
			[ `offset-sm-${ offsetSm }` ]: offsetSm,
			[ `offset-xs-${ offsetXs }` ]: offsetXs,
		} );

		return (
			<div className={ classes } style={ style }>
				<div>
					{ arrow && <ArrowBlock color={ customOverlayColor } id={ String( idBlock ) } /> }
					<InnerBlocks.Content />
				</div>
			</div>
		);
	},
} );

function opacityToClass( ratio ) {
	return ratio === 0 || ratio === 50 ? null : 'has-background-opacity-' + 10 * Math.round( ratio / 10 );
}

function backgroundImageStyles( url ) {
	return url ? { backgroundImage: `url(${ url })` } : {};
}

const withCustomClassName = createHigherOrderComponent( BlockListBlock => {
	return props => {
		if ( props.name === 'in-2019/col' ) {
			const { attributes } = props;
			const { xl, lg, md, sm, xs } = attributes;
			const { offsetXl, offsetLg, offsetMd, offsetSm, offsetXs } = attributes;

			const classes = classnames( {
				[ `col-xl-${ xl }` ]: xl,
				[ `col-lg-${ lg }` ]: lg,
				[ `col-md-${ md }` ]: md,
				[ `col-sm-${ sm }` ]: sm,
				[ `col-xs-${ xs }` ]: xs,
				[ `offset-xl-${ offsetXl }` ]: offsetXl,
				[ `offset-lg-${ offsetLg }` ]: offsetLg,
				[ `offset-md-${ offsetMd }` ]: offsetMd,
				[ `offset-sm-${ offsetSm }` ]: offsetSm,
				[ `offset-xs-${ offsetXs }` ]: offsetXs,
			} );

			return <BlockListBlock { ...props } className={ classes } />;
		}
		return <BlockListBlock { ...props } />;
	};
}, 'withClientIdClassName' );

wp.hooks.addFilter( 'editor.BlockListBlock', 'my-plugin/with-client-id-class-name', withCustomClassName );
