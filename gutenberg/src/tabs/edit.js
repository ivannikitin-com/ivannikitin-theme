import times from 'lodash/times';
import map from 'lodash/map';
import classnames from 'classnames';
import memize from 'memize';

const { __, sprintf } = wp.i18n;
const { Component, Fragment } = wp.element;
const {
	InnerBlocks,
	InspectorControls,
	RichText,
	BlockControls,
	ColorPalette,
	AlignmentToolbar,
	BlockAlignmentToolbar,
	MediaUpload,
	MediaUploadCheck,
} = wp.editor;
const {
	Button,
	ButtonGroup,
	Tooltip,
	TabPanel,
	Dashicon,
	PanelBody,
	RangeControl,
	ToggleControl,
	SelectControl,
} = wp.components;

const ALLOWED_BLOCKS = [ 'in-2019/tab' ];
const ALLOWED_MEDIA_TYPES = [ 'image' ];
const getPanesTemplate = memize( panes => {
	return times( panes, n => [ 'in-2019/tab', { id: n + 1 } ] );
} );

class Tabs extends Component {
	constructor() {
		super( ...arguments );
		this.state = {};
	}

	saveArrayUpdate( value, index ) {
		const { attributes, setAttributes } = this.props;
		const { titles } = attributes;

		const newItems = titles.map( ( item, thisIndex ) => {
			if ( index === thisIndex ) {
				item = { ...item, ...value };
			}

			return item;
		} );
		setAttributes( {
			titles: newItems,
		} );
	}

	render() {
		const { className, setAttributes, attributes } = this.props;
		const { tabCount, titles, currentTab } = attributes;

		const tabsCountChange = (
			<Fragment>
				<PanelBody>
					<RangeControl
						label={ __( 'Tabs', 'in-2019' ) }
						value={ tabCount }
						onChange={ nextTabs => {
							const newTabs = titles;
							if ( newTabs.length < nextTabs ) {
								const amount = Math.abs( nextTabs - newTabs.length );
								{
									times( amount, n => {
										const tabnumber = nextTabs - n;
										newTabs.push( {
											text: sprintf( __( 'Tab %d' ), tabnumber ),
											mediaID: null,
											url: '',
											alt: '',
										} );
									} );
								}
								setAttributes( { titles: newTabs } );
							}
							setAttributes( { tabCount: nextTabs } );
						} }
						min={ 1 }
						max={ 10 }
					/>
				</PanelBody>
			</Fragment>
		);

		const selectMedia = ( media, index ) => {
			this.saveArrayUpdate(
				{
					mediaID: media.id,
					url: media.url,
					alt: media.alt,
				},
				index
			);
		};

		const renderTitles = index => {
			return (
				<Fragment>
					<li>
						<div className={ `in-tab-title in-tab-title-${ 1 + index }` }>
							<img src={ titles[ index ].url } alt={ titles[ index ].alt } />
							<MediaUploadCheck>
								<MediaUpload
									onSelect={ media => selectMedia( media, index ) }
									allowedTypes={ ALLOWED_MEDIA_TYPES }
									value={ titles[ index ].mediaID }
									render={ ( { open } ) => <Button onClick={ open }>{ __( 'Open Media Library', 'palenight' ) }</Button> }
								/>
							</MediaUploadCheck>
							<RichText
								tagName="div"
								unstableOnFocus={ () => setAttributes( { currentTab: 1 + index } ) }
								placeholder={ __( 'Tab Title', 'in-2019' ) }
								value={ titles[ index ].text }
								onChange={ value => {
									this.saveArrayUpdate( { text: value }, index );
								} }
								formattingControls={ [ 'bold', 'italic', 'strikethrough' ] }
								className={ 'in-title-text' }
								keepPlaceholderOnFocus
							/>
						</div>
					</li>
				</Fragment>
			);
		};

		const renderPreviewArray = <Fragment>{ times( tabCount, n => renderTitles( n ) ) }</Fragment>;

		return (
			<Fragment>
				<InspectorControls>{ tabsCountChange }</InspectorControls>
				<div className={ className }>
					<div className="in-tabs-wrap">
						<ul className="in-tabs-title-list">{ renderPreviewArray }</ul>
					</div>
				</div>
			</Fragment>
		);
	}
}

export default Tabs;
