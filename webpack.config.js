const path = require('path');

export default {
    resolve: {
        alias: {
            '@' : path.resolve(__dirname, 'resources/js')
        }
    }
};
