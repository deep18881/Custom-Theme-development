import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import edit from './edit.js';
import save from './save.js';

registerBlockType('pheonix/heading-with-icon', {
    title: __('Heading with Icon', 'pheonix'),
    icon: 'megaphone',
    category: 'phoenix',
    attributes: {
        content: {
            type: 'string',
            source: 'html',
            selector: 'h3',
        },
        // 'icon': {
        //     'type': 'string',
        //     'default': 'dashicons dashicons-editor-justify'
        // }
    },

    edit: edit,

    save: save,
});