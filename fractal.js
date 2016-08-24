const fractal = module.exports = require('@frctl/fractal').create()

/* Set the title of the project */
fractal.set('project.title', 'GardenHui Component Library')
fractal.components.set('default.preview', '@preview');

const nunj = require('@frctl/nunjucks')({
  paths: [__dirname],
  filters: {
    parse_display_name: function parse_display_name(name) {
      return name.replace(/\./g, ' ');
    }
  },
  globals: {
    function: function() {
      // do nothing
    },
    TimberImage: function(url) {
      return {
        src: function() {
          return url
        }
      }
    },
    stylesheet: '<link rel="stylesheet" href="http://dev-gardenhui.pantheonsite.io/wp-content/themes/garden-hui-theme/style.css">',
    site: {
      theme: {
        uri: 'http://dev-gardenhui.pantheonsite.io/wp-content/themes/garden-hui-theme'
      }
    }
  }
})
fractal.components.engine(nunj);

/* Tell Fractal where the components will live */
fractal.components.set('path', __dirname + '/components')
fractal.components.set('ext', '.twig')

fractal.web.set('builder.dest', 'docs')

/* Tell Fractal where the documentation pages will live */
fractal.docs.set('path', __dirname + '/docs')
