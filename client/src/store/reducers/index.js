/**
 * npm import
 */
import { combineReducers } from 'redux';
import { reducer as formReducer } from 'redux-form';
/**
 * Local import
 */
import connect from 'src/store/reducers/connect';
import data from 'src/store/reducers/data';
import user from 'src/store/reducers/user';

const reducers = combineReducers({
  connect,
  user,
  data,
  form: formReducer,
});

/**
 * Export
 */
export default reducers;
