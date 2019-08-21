import Image from '../components/Image.jsx';
import classnames from 'classnames';

const { __ } = wp.i18n;
const apiFetch = wp.apiFetch;
const { addQueryArgs } = wp.url;
const { withSelect } = wp.data;
const { Fragment, Component } = wp.element;
const { PanelBody, TextControl, CheckboxControl, SelectControl } = wp.components;
const { InspectorControls, AlignmentToolbar } = wp.editor;

class Employee extends Component {
	constructor( props ) {
		super( ...arguments );
		this.state = {
			postTypes: [ {
				value: '',
				label: __( '---', 'in-2019' ),
			} ],
		};
		this.props = props;
	}

	componentDidMount() {
		this.isStillMounted = true;
		this.fetchRequest = apiFetch( {
			path: addQueryArgs( '/wp/v2/types/' ) } )
			.then( res => {
				if ( this.isStillMounted ) {
					const postTypesArray = this.state.postTypes;
					Object.keys( res ).forEach( ( key ) => {
						if (
							res[ key ].slug !== 'wp_block' &&
              res[ key ].slug !== 'attachment' &&
              res[ key ].slug !== 'page'
						) {
							postTypesArray.push( {
								value: res[ key ].slug,
								label: res[ key ].name,
							} );
						}
					} );

					this.setState( {
						postTypes: postTypesArray,
					} );
				}
			} )
			.catch( () => {
				if ( this.isStillMounted ) {
					this.setState( { postTypes: [] } );
				}
			} );
	}

	render() {
		const { className, setAttributes, attributes, posts } = this.props;
		const { postTypes } = this.state;
		const {
			widthImage,
			heighthImage,
			circleImage,
			alignment,
			currentPostType,
			currentPost,
			name,
			src,
			alt,
			url,
		} = attributes;

		const imageSettings = (
			<PanelBody
				title={ __( 'Settings Image', 'in-2019' ) }
				initialOpen={ false }
			>
				<TextControl
					label={ __( 'Width' ) }
					value={ widthImage }
					type="number"
					onChange={ ( widthImage ) => setAttributes( { widthImage } ) }
				/>
				<TextControl
					label={ __( 'Height' ) }
					value={ heighthImage }
					type="number"
					onChange={ ( heighthImage ) => setAttributes( { heighthImage } ) }
				/>
				<CheckboxControl
					label="Circle"
					checked={ circleImage }
					onChange={ ( circleImage ) => setAttributes( { circleImage } ) }
				/>
			</PanelBody>
		);

		const postList = ( posts ) => {
			const postList = [ {
				value: '',
				label: __( '---', 'in-2019' ),
			} ];

			posts.map( post => {
				postList.push( {
					value: post.id,
					label: post.title.rendered,
				} );
			} );

			return postList;
		};

		const selectPostType = (
			<PanelBody
				title={ __( 'Settings Content', 'in-2019' ) }
				initialOpen={ false }
			>
				<SelectControl
					label={ __( 'Select Post Type', 'in-2019' ) }
					value={ currentPostType }
					onChange={ currentPostType => {
						setAttributes( { currentPostType } );
					} }
					options={ postTypes }
				/>
				{ !! currentPostType && !! posts && (
					<SelectControl
						label={ __( 'Post', 'in-2019' ) }
						value={ currentPost }
						onChange={ currentPost => {
							setAttributes( { currentPost } );
						} }
						options={ postList( posts ) }
					/>
				) }
			</PanelBody>
		);

		const inspectorControls = (
			<InspectorControls>
				{ imageSettings }
				{ selectPostType }
			</InspectorControls>
		);

		const onChangeAlignment = ( updatedAlignment ) => {
			setAttributes( { alignment: updatedAlignment } );
		};

		const classes = classnames(
			className,
			`text-${ alignment }`
		);

		const viewPost = !! posts && posts.find( item => item.id === Number( currentPost ) );

		if ( viewPost ) {
			setAttributes( {
				name: viewPost.title.rendered,
				src: viewPost._embedded && viewPost._embedded[ 'wp:featuredmedia' ] ?
					viewPost._embedded[ 'wp:featuredmedia' ][ 0 ].source_url :
					null,
				alt: viewPost._embedded && viewPost._embedded[ 'wp:featuredmedia' ] ?
					viewPost._embedded[ 'wp:featuredmedia' ][ 0 ].alt_text :
					null,
				url: viewPost.link,
			} );
		}

		return (
			<Fragment>
				{ inspectorControls }
				<AlignmentToolbar
					value={ alignment }
					onChange={ onChangeAlignment }
				/>
				<div className={ classes }>
					{ !! viewPost && (
						<Fragment>
							<Image
								width={ widthImage }
								height={ heighthImage }
								circle={ circleImage }
								src={ src }
								alt={ alt }
							/>
							<div className="employee_name">{ name }</div>
							<div className="employee_rank"></div>
						</Fragment>
					) }
				</div>
			</Fragment>
		);
	}
}

export default withSelect( ( select, props ) => {
	const { attributes } = props;
	const { currentPostType } = attributes;
	const { getEntityRecords } = select( 'core' );

	return {
		posts: getEntityRecords( 'postType', currentPostType, { _embed: true, per_page: 100 } ),
	};
} )( Employee );
