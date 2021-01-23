import { library, dom } from '@fortawesome/fontawesome-svg-core'
import {
	faPhoneAlt,
	faTable,
	faTasks,
	faProjectDiagram,
	faUser,
	faEnvelope,
	faSearch,
	faStream,
	faShoppingCart,
	faRss,
} from '@fortawesome/free-solid-svg-icons'

import {
	faTwitter,
	faFacebook,
	faGoogle,
	faPinterest,
	faVk,
	faGooglePlus,
} from '@fortawesome/free-brands-svg-icons'

library.add(
	faPhoneAlt,
	faTable,
	faTasks,
	faProjectDiagram,
	faUser,
	faEnvelope,
	faSearch,
	faStream,
	faShoppingCart,
	faRss,
	faTwitter,
	faFacebook,
	faGoogle,
	faPinterest,
	faVk,
	faGooglePlus
)

dom.i2svg()
