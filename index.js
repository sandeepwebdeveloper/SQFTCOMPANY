import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps } from '@wordpress/block-editor';
import { TextControl } from '@wordpress/components';
import { useState } from '@wordpress/element';

import Swiper from 'swiper';
import 'swiper/swiper-bundle.css';

registerBlockType('your-theme/swiper', {
    edit() {
        const blockProps = useBlockProps();
        const [images, setImages] = useState('');

        return ( <
            div {...blockProps } >
            <
            TextControl label = "Image URLs (comma separated)"
            value = { images }
            onChange = {
                (value) => setImages(value)
            }
            /> < /
            div >
        );
    },
    save() {
        const blockProps = useBlockProps.save();
        return ( <
            div {...blockProps } >
            <
            div className = "swiper-container" >
            <
            div className = "swiper-wrapper" > { /* Here you can dynamically add swiper slides */ } <
            /div> < /
            div > <
            /div>
        );
    }
});