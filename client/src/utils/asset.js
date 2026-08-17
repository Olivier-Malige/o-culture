/**
 * Build a public URL for files stored in client/src/assets.
 * Accepts both "EventDefault.jpg" and "/events/photo.jpg".
 */
export const assetUrl = (path) => {
  if (!path) {
    return '/src/assets/EventDefault.jpg';
  }

  return `/src/assets/${String(path).replace(/^\/+/, '')}`;
};
