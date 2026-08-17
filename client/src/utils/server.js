/**
 * Import
 */
import axios from 'axios';

export const serverUrl = process.env.API_URL || '';

// Config pour axios
const baseConfig = {
  baseURL: serverUrl,
};

class Server {
  constructor(options = {}) {
    // Configuration
    this.config = {
      // Config de base
      ...baseConfig,
      // Config Žventuelle, fournie lors de l'instanciation
      ...options,
    };

    this.api = axios.create(this.config);
  }
}
/**
 * Export
 */
export default Server;
