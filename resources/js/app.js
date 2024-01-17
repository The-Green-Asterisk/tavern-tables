import './bootstrap';

import components from './components';
import constants from './const';
import pages from './pages';

import { initLoader } from './services/request';

const elements = new constants.El();
initLoader(elements);

switch (constants.PathNames.basePath()) {
    case constants.PathNames.HOME:
        pages.home(elements, components);
        break;
    default:
        break;
}