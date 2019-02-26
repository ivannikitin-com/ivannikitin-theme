import './style.scss';
import './editor.scss';
import icon from '-!svg-react-loader!../assets/news.svg';
import edit from './edit';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;

export const name = 'in-2019/news';

export const settings = {
	title: __( ' News ', 'in-2019' ),
	icon: icon,
	category: 'nikitin',
	supports: {
		html: false,
	},
	edit,
	save: () => {
		return null;
	},
};

registerBlockType( name, settings );
