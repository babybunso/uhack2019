module.exports = function(grunt) {

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		
		copy: {
			main: {
				files: [
					{expand: true, cwd: 'node_modules/bootstrap/dist/', src: ['**'], dest: 'pub/mods/bootstrap/'},
					{expand: true, cwd: 'node_modules/popper.js/dist/', src: ['**'], dest: 'pub/mods/popper.js/'},
					{expand: true, cwd: 'node_modules/jquery/dist/', src: ['**'], dest: 'pub/mods/jquery/'},
					{expand: true, cwd: 'node_modules/jquery-ui/', src: ['**'], dest: 'pub/mods/jquery-ui/'},
					{expand: true, cwd: 'node_modules/datatables.net/', src: ['**'], dest: 'pub/mods/datatables.net/'},
					{expand: true, cwd: 'node_modules/datatables.net-bs4/', src: ['**'], dest: 'pub/mods/datatables.net-bs4/'},
					{expand: true, cwd: 'node_modules/datatables.net-responsive/', src: ['**'], dest: 'pub/mods/datatables.net-responsive/'},
					{expand: true, cwd: 'node_modules/datatables.net-responsive-bs4/', src: ['**'], dest: 'pub/mods/datatables.net-responsive-bs4/'},
					{expand: true, cwd: 'node_modules/dropzone/dist/min/', src: ['**'], dest: 'pub/mods/dropzone/'},
					{expand: true, cwd: 'node_modules/font-awesome/', src: ['**'], dest: 'pub/mods/font-awesome/'},
					{expand: true, cwd: 'node_modules/jquery.cookie/', src: ['**'], dest: 'pub/mods/jquery.cookie/'},
					{expand: true, cwd: 'node_modules/select2/dist/', src: ['**'], dest: 'pub/mods/select2/'},
					{expand: true, cwd: 'node_modules/alertify/', src: ['**'], dest: 'pub/mods/alertify/'},
					{expand: true, cwd: 'node_modules/tiny-lr/', src: ['**'], dest: 'pub/mods/tinymce/'},
					{expand: true, cwd: 'node_modules/jquery.inputmask/dist/inputmask', src: ['**'], dest: 'pub/mods/jquery.inputmask/'},
					{expand: true, cwd: 'node_modules/blockui-mods/', src: ['**'], dest: 'pub/mods/blockui-mods/'},
					{expand: true, cwd: 'node_modules/@frontwise/grid-editor/dist/', src: ['**'], dest: 'pub/mods/grid-editor/'},
					{expand: true, cwd: 'node_modules/datetimepicker/dist/', src: ['**'], dest: 'pub/mods/datetimepicker/'},
					{expand: true, cwd: 'node_modules/tinymce/', src: ['**'], dest: 'pub/mods/tinymce/'},
					{expand: true, cwd: 'node_modules/jquery-number/', src: ['**'], dest: 'pub/mods/jquery-number/'},
					{expand: true, cwd: 'node_modules/fontawesome-iconpicker/dist/', src: ['**'], dest: 'pub/mods/fontawesome-iconpicker/'},
					{expand: true, cwd: 'node_modules/nestable2/dist/', src: ['**'], dest: 'pub/mods/nestable2/'},
				],
			},
		},
		cssmin: {
			css: {
				src: 'pub/themes/material/css/src/styles.css',
				dest: 'pub/themes/material/css/styles.min.css'
			},
			responsive: {
				src: 'pub/themes/material/css/src/responsive.css',
				dest: 'pub/themes/material/css/responsive.min.css'
			}
		},
		uglify: {
			js: {
				src: 'pub/themes/material/js/scripts.js',
				dest: 'pub/themes/material/js/scripts.min.js'
			}
		},
		watch: {
			css: {
				files: ['pub/themes/material/css/src/styles.css'],
				tasks: ['cssmin:css']
			},
			responsive: {
				files: ['pub/themes/material/css/src/responsive.css'],
				tasks: ['cssmin:responsive']
			},
			js: {
				files: ['pub/themes/material/js/scripts.js'], 
				tasks: ['uglify:js']
			}
		}
	});

	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-cssmin');

	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');	

	grunt.registerTask('default', ['copy', 'cssmin', 'uglify']);
};