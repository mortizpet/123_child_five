module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    sass: {
      dist: {
        files: {
          'build/css/build.css' : 'sass/main.scss',
        },
      },
    },
    concat: {
      options: {
        separator: ';',
      },
      banner: 
        '// ***********************\
        // * zrrdigitalmedia.com *\
        // ***********************\
        \
        \
        ',
      dist: {
        src: ['js_vendor/jquery-1.12.4.min.js', 'js/**/main.js'],
        dest: 'build/js/build.js',
      },
      exec: {
        src: ['js/exec.js'],
        dest: 'build/js/exec.js',
      }
    },
    uglify : {
      build : {
        files: {
          'build/js/build.js' : ['build/js/build.js'], 
          'build/js/exec.js' : ['build/js/exec.js']
        }
      }
    },
    cssmin : {
      build: {
        files: [{
          expand: true,
          cwd: 'build/css',
          src: ['*.css', '!*.min.css'],
          dest: 'build/css',
          ext: '.css'
        }]
      }
    },
    watch: {
      sass: {
        files: ['sass/**/*.scss'],
        tasks: ['sass'],
        options: {
          livereload : 35729
        },
      },
      js: {
        files: ['js/**/*.js'],
        tasks: ['concat'],
        options: {
          livereload : 35729
        },
      },
      php: {
        files: ['**/*.php'],
        options: {
          livereload : 35729
        },
      },
      options: {
        style: 'expanded',
        compass: true,
      },
    },
  });

  
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-uglify');

  grunt.registerTask('default', ['sass', 'concat', 'watch']);
  grunt.registerTask('slim', ['sass', 'concat', 'cssmin', 'uglify']);


};