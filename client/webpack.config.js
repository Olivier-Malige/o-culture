// Node import
const path = require('path');
const webpack = require('webpack');

// Plugins de traitement pour dist/
const TerserPlugin = require("terser-webpack-plugin");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const OptimizeCSSAssetsPlugin = require("optimize-css-assets-webpack-plugin");
const HtmlWebPackPlugin = require('html-webpack-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');

// Config pour le devServer
const host = process.env.DEV_HOST || 'localhost';
const port = Number(process.env.DEV_PORT || 3000);
const publicAddr = process.env.DEV_PUBLIC || `localhost:${port}`;
const [sockHost, sockPortFromPublic] = publicAddr.split(':');
const pollEnv = process.env.DEV_POLL;
const pollMs = !pollEnv || pollEnv === '0'
  ? 0
  : (Number(pollEnv) === 1 ? 300 : Number(pollEnv));
const apiProxy = process.env.API_PROXY || 'http://localhost:8080';
const proxy = {};
['/api', '/admin', '/chat', '/css', '/bundles'].forEach((proxyPath) => {
  proxy[proxyPath] = { target: apiProxy, changeOrigin: true };
});

const devMode = process.env.NODE_ENV !== 'production';

// Config de Webpack
module.exports = {
  // Passe le build par dèfaut en déeveloppement
  mode: 'development',
  // Expose le dossier src/ pour les imports
  resolve: {
    alias: {
      src: path.resolve(__dirname, 'src/'),
    },
  },
  // Points d'entrée pour le travail de Webpack
  entry: {
    app: [
      // Styles
      './src/styles/index.sass',
      // JS
      './src/index.js',
    ],
  },
  // Sortie
  output: {
    // Nom du bundle
    filename: 'app.js',
    // Nom du bundle vendors si l'option d'optimisation / splitChunks est activée
    chunkFilename: 'vendors.js',
    // Cible des bundles
    path: path.resolve(__dirname, 'dist'),
    publicPath: '/',
  },
  // Optimisation pour le build
  optimization: {
    // Code spliting
    splitChunks: {
      chunks: 'all',
    },
    // Minification
    minimizer: [
      new TerserPlugin({
        cache: true,
        parallel: true,
        sourceMap: false
      }),
      new OptimizeCSSAssetsPlugin({})
    ]
  },
  // Modules
  module: {
    rules: [
      // JS
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: [
          // babel avec une option de cache
          {
            loader: 'babel-loader',
            options: {
              cacheDirectory: true,
            },
          },
        ],
      },
      // CSS / SASS / SCSS
      {
        test: /\.(sa|sc|c)ss$/,
        use: [
          // style-loader ou fichier
          devMode ? 'style-loader' :
            MiniCssExtractPlugin.loader,
          // Chargement du CSS
          'css-loader',
          {
            loader: 'postcss-loader',
            options: {
              plugins: () => [require('autoprefixer')],
              sourceMap: true,
            },
          },
          {
            loader: 'sass-loader',
            options: {
              implementation: require('sass'),
            },
          },
        ],
      },
      // Inages
      {
        test: /\.(png|svg|jpg|gif)$/,
        use: [
          {
            loader: 'file-loader',
            options: {
              outputPath: 'assets/',
            },
          },
        ],
      },
    ],
  },
  devServer: {
    overlay: true, // Overlay navigateur si erreurs de build
    stats: 'minimal', // Infos en console limitées
    progress: Boolean(process.stdout.isTTY), // progression du build en console
    inline: true, // Rechargement du navigateur en cas de changement
    hot: true,
    liveReload: true,
    open: process.env.DEV_OPEN !== '0', // on ouvre le navigateur
    historyApiFallback: true,
    disableHostCheck: true,
    host: host,
    port: port,
    public: publicAddr,
    sockHost,
    sockPort: Number(sockPortFromPublic || port),
    proxy,
    watchOptions: {
      ignored: /node_modules/,
      aggregateTimeout: 300,
      ...(pollMs > 0 ? { poll: pollMs } : {}),
    },
  },
  plugins: [
    new webpack.DefinePlugin({
      'process.env.API_URL': JSON.stringify(process.env.API_URL || ''),
    }),
    new CopyWebpackPlugin([
      {
        from: 'src/assets/',
        force: true,
        to: 'src/assets',
        toType: 'dir'
      },
    ]),
    new CopyWebpackPlugin([
      {
        from: '_redirects',
      },
    ]),
    // Permet de prendre le index.html de src comme base pour le fichier de dist/
    new HtmlWebPackPlugin({
      template: './src/index.html',
      filename: './index.html',
    }),
    // Permet d'exporter les styles CSS dans un fichier css de dist/
    new MiniCssExtractPlugin({
      filename: '[name].css',
      chunkFilename: '[id].css',
    }),
  ],
};
