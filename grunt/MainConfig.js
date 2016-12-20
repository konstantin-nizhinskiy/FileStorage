"use strict";

var grunt = require('grunt');

module.exports = {
    pkg:grunt.file.readJSON('package.json'),
    hostName:'',
    banner: '\nname: <%= pkg.name %>\n' +
    'version: <%= pkg.version %>\n' +
    'author: <%= pkg.author %>\n' +
    'date: <%= grunt.template.today("yyyy-mm-dd HH:mm:ss") %> \n\n'

};
