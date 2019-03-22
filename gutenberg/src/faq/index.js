import './style.scss';
import './editor.scss';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;

const { RichText } = wp.editor;

registerBlockType( 'in-2019/faq', {
	title: __( 'FAQ', 'in-2019' ),
	category: 'nikitin',
	attributes: {
		title: {
			type: 'string',
			default: __( 'What is it?', 'in-2019' ),
		},
		description: {
			type: 'string',
		},
	},
	edit: props => {
		const { className, attributes, setAttributes } = props;
		const { title, description } = attributes;

		return (
			<div className={ className }>
				<div className="wp-block-in-2019-faq__image" />
				<div className="wp-block-in-2019-faq__text">
					<RichText
						tagName="div"
						className="wp-block-in-2019-faq__title"
						value={ title }
						onChange={ value => setAttributes( { title: value } ) }
						placeholder={ __( 'Title', 'in-2019' ) }
						keepPlaceholderOnFocus
					/>
					<RichText
						tagName="p"
						value={ description }
						onChange={ value => setAttributes( { description: value } ) }
						placeholder={ __( 'Description', 'in-2019' ) }
						keepPlaceholderOnFocus
					/>
				</div>
			</div>
		);
	},
	save: ( { attributes } ) => {
		const { title, description } = attributes;

		return (
			<div>
				<div className="wp-block-in-2019-faq__image" />
				<div className="wp-block-in-2019-faq__text">
					<RichText.Content tagName="div" className="wp-block-in-2019-faq__title" value={ title } />
					<RichText.Content tagName="p" value={ description } />
				</div>
			</div>
		);
	},
} );
