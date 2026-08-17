/*
 * Npm import
 */
import { createStore, applyMiddleware, compose } from 'redux';

/*
 * Local import
 */
// Reducer
import reducer from 'src/store/reducers/';
// Middlewares
import user from './middlewares/userAjax';
import connect from './middlewares/connectAjax';
import data from './middlewares/dataAjax';
/*
 * Code
 */
const devTools = [];
if (window.devToolsExtension) {
  devTools.push(window.devToolsExtension());
}

// Apply the middleware in the course of the action
const appliedMiddleware = applyMiddleware(data, user, connect);
// Assembling middlewares and dev tools
const enhancers = compose(appliedMiddleware, ...devTools);
// CreateStore
const store = createStore(reducer, enhancers);
/*
 * Export
 */
export default store;
