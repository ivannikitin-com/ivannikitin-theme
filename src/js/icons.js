import { library, dom } from '@fortawesome/fontawesome-svg-core';
import {
	faPhoneAlt,
	faTable,
	faTasks,
	faProjectDiagram,
	faUser,
	faEnvelope,
	faSearch,
	faStream,
} from '@fortawesome/free-solid-svg-icons';

library.add(faPhoneAlt, faTable, faTasks, faProjectDiagram, faUser, faEnvelope, faSearch, faStream);

dom.i2svg();
