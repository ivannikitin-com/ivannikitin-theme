import pickBy from 'lodash/pickBy';
import isUndefined from 'lodash/isUndefined';
import classnames from 'classnames';

const { __ } = wp.i18n;
const { withSelect } = wp.data;
const { addQueryArgs } = wp.url;
const apiFetch = wp.apiFetch;
const { dateI18n, format, __experimentalGetSettings } = wp.date;
const { Component, Fragment, RawHTML } = wp.element;
const { PanelBody, QueryControls, ToggleControl, Placeholder, Spinner } = wp.components;
const { InspectorControls } = wp.editor;

const CATEGORIES_LIST_QUERY = {
	pre_page: -1,
};

class News extends Component {
	constructor() {
		super( ...arguments );
		this.state = {
			categoriesList: [],
		};
	}

	componentDidMount() {
		this.isStillMounted = true;
		this.fetchRequest = apiFetch( {
			path: addQueryArgs( '/wp/v2/categories', CATEGORIES_LIST_QUERY ),
		} )
			.then( categoriesList => {
				if ( this.isStillMounted ) {
					this.setState( { categoriesList } );
				}
			} )
			.catch( () => {
				if ( this.isStillMounted ) {
					this.setState( { categoriesList: [] } );
				}
			} );
	}

	componentDidUnmount() {
		this.isStillMounted = false;
	}

	render() {
		const { attributes, setAttributes, lastestNews } = this.props;
		const { categoriesList } = this.state;
		const { displayPostDate, order, orderBy, categories, postsToShow } = attributes;

		const inspectorControls = (
			<InspectorControls>
				<PanelBody title={ __( 'News settings', 'in-2019' ) }>
					<QueryControls
						{ ...{ order, orderBy } }
						numberOfItems={ postsToShow }
						categoriesList={ categoriesList }
						selectedCategoryId={ categories }
						onOrderChange={ value => setAttributes( { order: value } ) }
						onOrderByChange={ value => setAttributes( { orderBy: value } ) }
						onCategoryChange={ value => setAttributes( { categories: '' !== value ? value : undefined } ) }
						onNumberOfItemsChange={ value => setAttributes( { postsToShow: value } ) }
					/>
					<ToggleControl
						label={ __( 'Display post date' ) }
						checked={ displayPostDate }
						onChange={ value => setAttributes( { displayPostDate: value } ) }
					/>
				</PanelBody>
			</InspectorControls>
		);

		const hasPosts = Array.isArray( lastestNews ) && lastestNews.length;
		if ( ! hasPosts ) {
			return (
				<Fragment>
					{ inspectorControls }
					<Placeholder icon="admin-post" label={ __( 'Latest Posts' ) }>
						{ ! Array.isArray( lastestNews ) ? <Spinner /> : __( 'No posts found.' ) }
					</Placeholder>
				</Fragment>
			);
		}

		const displayPosts = lastestNews.length > postsToShow ? lastestNews.slice( 0, postsToShow ) : lastestNews;

		const dateFormat = __experimentalGetSettings().formats.date;

		const classes = classnames( this.props.className, 'row', {
			'has-dates': displayPostDate,
		} );

		return (
			<Fragment>
				{ inspectorControls }
				<div className={ classes }>
					{ displayPosts.map( ( post, index ) => {
						const titleTrimmed = post.title.rendered.trim();
						const backgroundImage =
							post._embedded && post._embedded[ 'wp:featuredmedia' ] ?
								post._embedded[ 'wp:featuredmedia' ][ 0 ].source_url :
								null;
						const styleNews = {
							backgroundImage: `url( ${ backgroundImage } )`,
						};

						return (
							<div className="col-md-4 wp-block-in-2019-news_item mb-3 mb-sm-4 mb-md-4" key={ index }>
								<div className="wp-block-in-2019-news_thumb" style={ styleNews } />
								<div className="card-body">
									<h5 className="wp-block-in-2019-news_title">
										{ titleTrimmed ? <RawHTML>{ titleTrimmed }</RawHTML> : __( '(Untitled)' ) }
									</h5>
									{ displayPostDate && post.date_gmt && (
										<time dateTime={ format( 'c', post.date_gmt ) } className="wp-block-in-2019-news_date">
											{ dateI18n( dateFormat, post.date_gmt ) }
										</time>
									) }
									<a href={ post.link } className="wp-block-in-2019-news_link">
										{ __( 'читать далее', 'palenight' ) }
									</a>
								</div>
							</div>
						);
					} ) }
				</div>
			</Fragment>
		);
	}
}

export default withSelect( ( select, props ) => {
	const { postsToShow, order, orderBy, categories } = props.attributes;
	const { getEntityRecords } = select( 'core' );
	const latestPostsQuery = pickBy(
		{
			categories,
			order,
			orderby: orderBy,
			per_page: postsToShow,
			_embed: true,
		},
		value => ! isUndefined( value )
	);
	return {
		lastestNews: getEntityRecords( 'postType', 'post', latestPostsQuery ),
	};
} )( News );
