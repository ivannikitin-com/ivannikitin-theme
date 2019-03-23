import './style.scss';
import './editor.scss';
import edit from './edit';
import save from './save';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;

registerBlockType( 'in-2019/carousel', {
	title: __( 'Carousel', 'in-2019' ),
	category: 'nikitin',
	attributes: {
		nav: {
			type: 'boolean',
			default: false,
		},
		items: {
			type: 'number',
			default: 3,
		},
		slides: {
			type: 'array',
			default: [
				{
					title: __( 'Title', 'in-2019' ),
					description: __( 'Description', 'in-2019' ),
					text_gift: __( 'gift for order', 'in-2019' ),
					gift: true,
					values: __( '<li>Point</li>', 'in-2019' ),
					price: '1 000 ₽',
				},
				{
					title: __( 'Title', 'in-2019' ),
					description: __( 'Description', 'in-2019' ),
					text_gift: __( 'gift for order', 'in-2019' ),
					gift: true,
					values: __( '<li>Point</li>', 'in-2019' ),
					price: '1 000 ₽',
				},
				{
					title: __( 'Title', 'in-2019' ),
					description: __( 'Description', 'in-2019' ),
					text_gift: __( 'gift for order', 'in-2019' ),
					gift: true,
					values: __( '<li>Point</li>', 'in-2019' ),
					price: '1 000 ₽',
				},
			],
		},
	},
	edit,
	save,
} );
