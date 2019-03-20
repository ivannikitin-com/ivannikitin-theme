import './style.scss';
import './editor.scss';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;

registerBlockType( 'in-2019/site-creation', {
	title: __( 'Site creation', 'in-2019' ),
	category: 'nikitin',
	edit: () => {
		return (
			<div>
				<h1>Tabs Demo</h1>
			</div>
		);
	},
	save: () => {
		return null;
	},
} );
