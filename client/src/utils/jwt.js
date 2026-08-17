/**
 * Import
 */
import jwtDecode from 'jwt-decode';

/**
 * Code
 */
// Decode the token in the localStorage
export const parseJwt = () => {
  const tokenFromStorage = localStorage.getItem('token');
  if (!tokenFromStorage) {
    return false;
  }
  try {
    return jwtDecode(tokenFromStorage);
  } catch (error) {
    return false;
  }
};

/**
 * Export
 */
export default parseJwt;
