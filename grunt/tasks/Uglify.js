
"use strict";
var path = require('path'),
    grunt = require('grunt');
module.exports = {
    uglify: {
        options: {
            banner: '/*<%= banner %>*/',
            compress: {
                drop_console: true
            }
        },
        FileStorage: {
            files: {
                'web/js/FileStorage.min.js':[
                    'web/js/FileStorage.min.js'
                ]



            }
        }
    }
};