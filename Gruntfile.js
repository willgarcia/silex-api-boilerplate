var execSync = require("exec-sync");

module.exports = function(grunt) {

    grunt.initConfig({
        dirs: {
            phpmd: [
                'app',
                'src',
                'tests'
            ]
        }
    });

    grunt.registerTask('composer:install', function() {
        console.log(execSync('composer install --ansi --dev'));
    });

    grunt.registerTask('phpmd:html', function() {
        console.log(execSync('bin/phpmd ' + grunt.config.data.dirs.phpmd.join(',') + ' html .phpmd.xml --suffixes=php --reportfile phpmd-report.html'));
    });

    grunt.registerTask('phpcs:fix', function() {
        console.log(execSync('bin/php-cs-fixer fix --ansi --config-file=.php_cs --level=all'));
    });

    grunt.registerTask('default', ['composer:install', 'phpmd:html', 'phpcs:fix']);
};
