
"use strict";
var path = require('path'),
    grunt = require('grunt');
grunt.task.registerTask('buildPrototype','build prototype',function(){
    var prototype=[''],
    config=grunt.config();
    grunt.file.recurse('src/FrontBundle/js/prototype', function (a) {
        prototype.push(grunt.file.read(a));
    });
    grunt.file.write('web/js/FileStorage.min.js',grunt.template.process(
        grunt.file.read('src/FrontBundle/js/FileStorage.js'),
        {
            data:{
                prototype:prototype.join('\n'),
                hostName:config.hostName
            }
        }));

});