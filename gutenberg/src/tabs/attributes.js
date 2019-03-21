const { __ } = wp.i18n;
const attributes = {
	uniqueID: {
		type: 'string',
		default: '',
	},
	tabCount: {
		type: 'number',
		default: 3,
	},
	currentTab: {
		type: 'number',
		default: 1,
	},
	titles: {
		type: 'array',
		default: [
			{
				text: __( 'Tab 1' ),
				mediaID: null,
				url: '',
				alt: '',
			},
			{
				text: __( 'Tab 2' ),
				mediaID: null,
				url: '',
				alt: '',
			},
			{
				text: __( 'Tab 3' ),
				mediaID: null,
				url: '',
				alt: '',
			},
		],
	},
};
export default attributes;
