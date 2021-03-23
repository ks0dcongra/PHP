module.exports = {
    devServer: {
      // disableHostCheck: true,
      proxy : {
        '/api': {
          changeOrigin: true,
          target: 'http://localhost:8018',
          bypass: function(req, res, proxyOptions) {
            //console.log('vue7', req.headers.accept);
            if (req.headers.accept.indexOf('html') !== -1) {
              //console.log('Skipping proxy for browser request.');
              return '/index.html';
            }
          }
        },
        '/badge': {
          target: 'http://lguniv-staging-lgunivsquarephase2ha-11013.gcld-line.com'
        },
        // '/shop': {
        //   secure: false,
        //   changeOrigin: true,
        //   target: 'https://lguniv-staging-lgunivsquarephase2ha-11013.gcld-line.com/event/events?'
        // }
      },

    },
    // 建置前端靜態檔案時要擺放的目錄
    // 在 package.json 也要調整 "build" 這個 script
    outputDir: '../dist',

    assetsDir: './dist',
  
    // 開發階段修改 index.html 來讓 js/css 可以作用
    // 上線階段則會修改 Laravel 的樣版
    indexPath: process.env.NODE_ENV === 'production'
      ? /*'../resources/views/index.blade.php'*/'index.html'
      : 'index.html',
    publicPath: process.env.NODE_ENV === 'production'
      ? './' // prod
      : './', // dev
    //export vue-clamp才能做文章過長的刪節 
    transpileDependencies: ['vue-clamp', 'resize-detector']
    

      
  }