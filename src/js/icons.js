import { library, dom } from '@fortawesome/fontawesome-svg-core';
import { faTable, faTasks, faProjectDiagram, faUser } from '@fortawesome/free-solid-svg-icons';
// import { far } from '@fortawesome/free-regular-svg-icons'
// import { fab } from '@fortawesome/free-brands-svg-icons';

library.add(faTable, faTasks, faProjectDiagram, faUser);

dom.i2svg();
