module.exports = function (grunt) {

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		meta: {
			banner: '/* this ist the minified js, build in <%= grunt.template.today(); %>.*/'
		},

		min: {
			dist: {
				src: ['<banner>', 'www/js/*.js'],
				dest: 'main.min.js'
			}
		},

		watch: {
			files: ['www/js/*.js'],
			tasks: ['min:dist']
		}
	});

	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-qunit');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-concat');

	grunt.registerTask('default', [
		'min:dist'
	]);
};