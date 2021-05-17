tinymce.init({
    selector: 'textarea.tinymce',
    forced_root_block: '',
    style_formats: [{
        title: 'Headings',
        items: [{
                title: 'Heading 2',
                format: 'h2'
            },
            {
                title: 'Heading 3',
                format: 'h3'
            },
            {
                title: 'Heading 4',
                format: 'h4'
            },
            {
                title: 'Heading 5',
                format: 'h5'
            },
            {
                title: 'Heading 6',
                format: 'h6'
            }
        ]
    }]
});