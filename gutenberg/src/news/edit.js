import { isUndefined, pickBy } from 'lodash';
import classnames from 'classnames';
import Image from '../components/Image.jsx';

const { __ } = wp.i18n;
const { withSelect } = wp.data;
const { addQueryArgs } = wp.url;
const apiFetch = wp.apiFetch;
const { dateI18n, format, __experimentalGetSettings } = wp.date;
const {
	Component,
	Fragment,
	RawHTML,
} = wp.element;
const {
	PanelBody,
	QueryControls,
	ToggleControl,
	Placeholder,
	Spinner,
} = wp.components;
const {
	InspectorControls,
} = wp.editor;

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
				<PanelBody
					title={ __( 'News settings', 'in-2019' ) }
				>
					<QueryControls
						{ ...{ order, orderBy } }
						numberOfItems={ postsToShow }
						categoriesList={ categoriesList }
						selectedCategoryId={ categories }
						onOrderChange={ ( value ) => setAttributes( { order: value } ) }
						onOrderByChange={ ( value ) => setAttributes( { orderBy: value } ) }
						onCategoryChange={ ( value ) => setAttributes( { categories: '' !== value ? value : undefined } ) }
						onNumberOfItemsChange={ ( value ) => setAttributes( { postsToShow: value } ) }
					/>
					<ToggleControl
						label={ __( 'Display post date' ) }
						checked={ displayPostDate }
						onChange={ ( value ) => setAttributes( { displayPostDate: value } ) }
					/>
				</PanelBody>
			</InspectorControls>
		);

		const hasPosts = Array.isArray( lastestNews ) && lastestNews.length;
		if ( ! hasPosts ) {
			return (
				<Fragment>
					{ inspectorControls }
					<Placeholder
						icon="admin-post"
						label={ __( 'Latest Posts' ) }
					>
						{ ! Array.isArray( lastestNews ) ?
							<Spinner /> :
							__( 'No posts found.' )
						}
					</Placeholder>
				</Fragment>
			);
		}

		const displayPosts = lastestNews.length > postsToShow ?
			lastestNews.slice( 0, postsToShow ) :
			lastestNews;

		const dateFormat = __experimentalGetSettings().formats.date;

		const classes = classnames(
			this.props.className,
			{
				'has-dates': displayPostDate,
			}
		);

		return (
			<Fragment>
				{ inspectorControls }
				<ul
					className={ classes }
				>
					{ displayPosts.map( ( post, index ) => {
						const titleTrimmed = post.title.rendered.trim();
						return (
							<li key={ index }>
								<a href={ post.link }>
									<Image
										src={ post._embedded && post._embedded[ 'wp:featuredmedia' ] ?
											post._embedded[ 'wp:featuredmedia' ][ 0 ].source_url :
											null }
										alt={ post._embedded && post._embedded[ 'wp:featuredmedia' ] ?
											post._embedded[ 'wp:featuredmedia' ][ 0 ].alt_text :
											null }
									/>
									{ titleTrimmed ? (
										<RawHTML>
											{ titleTrimmed }
										</RawHTML>
									) :
										__( '(Untitled)' )
									}
									{ displayPostDate && post.date_gmt &&
									<time dateTime={ format( 'c', post.date_gmt ) } className="wp-block-latest-posts__post-date">
										{ dateI18n( dateFormat, post.date_gmt ) }
									</time>
									}
								</a>
							</li>
						);
					} ) }
				</ul>
			</Fragment>
		);
	}
}

export default withSelect( ( select, props ) => {
	const { postsToShow, order, orderBy, categories } = props.attributes;
	const { getEntityRecords } = select( 'core' );
	const latestPostsQuery = pickBy( {
		categories,
		order,
		orderby: orderBy,
		per_page: postsToShow,
		_embed: true,
	}, ( value ) => ! isUndefined( value ) );
	return {
		lastestNews: getEntityRecords( 'postType', 'post', latestPostsQuery ),
	};
} )( News );
