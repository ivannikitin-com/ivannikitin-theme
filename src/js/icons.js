import { library, dom } from '@fortawesome/fontawesome-svg-core';
import {
    faPhoneAlt,
    faTable,
    faTasks,
    faProjectDiagram,
    faUser,
    faEnvelope,
} from '@fortawesome/free-solid-svg-icons';
// import { far } from '@fortawesome/free-regular-svg-icons'
// import { fab } from '@fortawesome/free-brands-svg-icons';

library.add(faPhoneAlt, faTable, faTasks, faProjectDiagram, faUser, faEnvelope);

dom.i2svg();
