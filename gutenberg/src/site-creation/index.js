import './style.scss';
import './editor.scss';
import Tabs from './components/tabs';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;

registerBlockType( 'in-2019/site-creation', {
	title: __( 'Site creation', 'in-2019' ),
	category: 'nikitin',
	edit: () => {
		return (
			<div>
				<h1>Tabs Demo</h1>
				<Tabs>
					<div label="Gator">
						See ya later, <em>Alligator</em>!
					</div>
					<div label="Croc">
						After while, <em>Crocodile</em>!
					</div>
					<div label="Sarcosuchus">
						Nothing to see here, this tab is <em>extinct</em>!
					</div>
				</Tabs>
			</div>
		);
	},
	save: () => {
		return (
			<div>
				<h1>Tabs Demo</h1>
				<Tabs>
					<div label="Gator">
						See ya later, <em>Alligator</em>!
					</div>
					<div label="Croc">
						After while, <em>Crocodile</em>!
					</div>
					<div label="Sarcosuchus">
						Nothing to see here, this tab is <em>extinct</em>!
					</div>
				</Tabs>
			</div>
		);
	},
} );
