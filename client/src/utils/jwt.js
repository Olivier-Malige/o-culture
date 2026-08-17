/**
 * Import
 */
import jwtDecode from 'jwt-decode';

/**
 * Decode the JWT stored in localStorage, or false if missing/expired/invalid.
 */
export const parseJwt = () => {
  const tokenFromStorage = localStorage.getItem('token');
  if (!tokenFromStorage) {
    return false;
  }
  try {
    const payload = jwtDecode(tokenFromStorage);
    if (payload.exp && payload.exp * 1000 < Date.now()) {
      localStorage.removeItem('token');
      return false;
    }
    return payload;
  } catch (error) {
    localStorage.removeItem('token');
    return false;
  }
};

/**
 * Export
 */
export default parseJwt;
