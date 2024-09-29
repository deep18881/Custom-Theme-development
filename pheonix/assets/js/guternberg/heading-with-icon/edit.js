import { __ } from '@wordpress/i18n';
import { RichText } from '@wordpress/block-editor';

const edit = (props) => {
    return (
        <div className="pheonix-block-heading">
            <RichText
                tagName="h3"
                value={props.attributes.content}
                onChange={(content) => props.setAttributes({ content })}
                placeholder={__('Enter your content here', 'pheonix')}
            />
        </div>
    );
}

export default edit;